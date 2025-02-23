<?php

/**
 * Represents a study group.
 *
 * Holds information fetched from the Study Group Manager website.
 *
 */
class StudyGroup
{
  public $id;
  public $data;

  function __construct($id, $data)
  {
    $this->id = $id;
    $this->data = $data;
  }

  public function pageData()
  {
    $data = [
      'slug' => Str::slug($this->id),
      'template' => 'arbeitsgemeinschaft',
      'model' => 'arbeitsgemeinschaft',
      'content' => $this->data
    ];

    return $data;
  }
}

/**
 * Model for the groups displaying all the study groups and the news for those groups.
 *
 * Children are virtual pages: The information about the current study groups is fetched from the Study Group
 * Manager website as JSON data and cached locally.
 */
class AgsPage extends Page
{
  private const EMPTY_JSON_STRUCTURE = [
    "current_term_year" => "",
    "study_groups" => []
  ];

  public function children(): Pages
  {
    $results = [];
    $pages = [];

    $data = $this->studyGroupsData();

    foreach ($data['study_groups'] as $id => $study_group_data) {
      $study_group = new StudyGroup($id, $study_group_data);

      $pages[] = $study_group->pageData();
    }

    return Pages::factory($pages, $this);
  }

  public function termYear(): string
  {
    return $this->studyGroupsData()['current_term_year'] ?? "";
  }

  private function studyGroupsData()
  {
    if ($this->hasCachedStudyGroupsData() && !$this->hasStaleCachedStudyGroupsData()) {
      return $this->readCachedStudyGroupsData();
    } else {
      return $this->fetchStudyGroupsData();
    }
  }

  private function hasCachedStudyGroupsData()
  {
    return F::exists($this->studyGroupsDataCacheFilePath());
  }

  private function hasStaleCachedStudyGroupsData()
  {
    return (time() - F::modified($this->studyGroupsDataCacheFilePath())) > 86400;
  }

  private function readCachedStudyGroupsData()
  {
    $data = Data::read($this->studyGroupsDataCacheFilePath(), 'json');

    return is_array($data) && isset($data['study_groups']) ? $data : self::EMPTY_JSON_STRUCTURE;
  }

  private function fetchStudyGroupsData()
  {
    $request = Remote::get($this->apiEndpointUri() . '?token=' . $this->apiKey());

    if ($request->code() === 200) {
      $data = $request->json(true);

      if ($this->isValidStudyGroupsData($data)) {
        $this->updateStudyGroupsDataCache($data);
        return $data;
      }
    }

    // API fehlgeschlagen oder ungültige Daten → Speichere leere Struktur
    $this->updateStudyGroupsDataCache(self::EMPTY_JSON_STRUCTURE);

    return self::EMPTY_JSON_STRUCTURE;
  }

  private function isValidStudyGroupsData($data)
  {
    return is_array($data) && isset($data['study_groups']) && is_array($data['study_groups']);
  }

  private function updateStudyGroupsDataCache($data)
  {
    Data::write($this->studyGroupsDataCacheFilePath(), $data, 'json');
  }

  private function studyGroupsDataCacheFilePath()
  {
    return $this->kirby()->root('cache') . "/" . 'arbeitsgemeinschaften.json';
  }

  private function apiEndpointUri()
  {
    return Config::get('studyGroups.url');
  }

  private function apiKey()
  {
    return Config::get('studyGroups.apiKey');
  }
}
?>
