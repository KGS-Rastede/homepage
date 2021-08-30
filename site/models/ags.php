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
  public function children()
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
    return Data::read($this->studyGroupsDataCacheFilePath(), 'json');
  }

  private function fetchStudyGroupsData()
  {
    $request = Remote::get($this->apiEndpointUri() . '?token=' . $this->apiKey());

    if ($request->code() === 200) {
      $data = $request->json(true);

      $this->updateStudyGroupsDataCache($data);

      return $data;
    } else {
      if ($this->hasCachedStudyGroupsData()) {
        return $this->readCachedStudyGroupsData();
      } else {
        throw 'Could not load study group information from remote system.';
      }
    }
  }

  private function updateStudyGroupsDataCache($data)
  {
    Data::write($this->studyGroupsDataCacheFilePath(), $data, 'json');
  }

  private function studyGroupsDataCacheFilePath()
  {
    return $this->kirby()->root('cache') . DS . 'arbeitsgemeinschaften.json';
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
