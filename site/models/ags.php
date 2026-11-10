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
            'content' => $this->data,
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
        return $this->studyGroupsData()['current_term_year'];
    }

    private function studyGroupsData()
    {
        if (
            $this->hasCachedStudyGroupsData() &&
            !$this->hasStaleCachedStudyGroupsData()
        ) {
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
        return time() - F::modified($this->studyGroupsDataCacheFilePath()) >
            86400;
    }

    private function readCachedStudyGroupsData()
    {
        return Data::read($this->studyGroupsDataCacheFilePath(), 'json');
    }

    private function fetchStudyGroupsData()
    {
        // Ohne Konfiguration (z. B. lokal ohne secrets.php) gar nicht erst anfragen.
        if (empty($this->apiEndpointUri()) || empty($this->apiKey())) {
            return $this->fallbackStudyGroupsData();
        }

        try {
            $request = Remote::get(
                $this->apiEndpointUri() . '?token=' . urlencode($this->apiKey()),
            );

            if ($request->code() === 200) {
                $data = $request->json(true);

                if (is_array($data) && isset($data['study_groups'])) {
                    $this->updateStudyGroupsDataCache($data);
                    return $data;
                }
            }
        } catch (\Throwable $e) {
            // Netzwerk-/Konfigurationsfehler: weiter mit Fallback
        }

        return $this->fallbackStudyGroupsData();
    }

    /**
     * Veralteter Cache, falls vorhanden – sonst eine leere AG-Liste.
     */
    private function fallbackStudyGroupsData()
    {
        if ($this->hasCachedStudyGroupsData()) {
            return $this->readCachedStudyGroupsData();
        }

        return [
            'study_groups'      => [],
            'current_term_year' => '',
        ];
    }

    private function updateStudyGroupsDataCache($data)
    {
        Data::write($this->studyGroupsDataCacheFilePath(), $data, 'json');
    }

    private function studyGroupsDataCacheFilePath()
    {
        return $this->kirby()->root('cache') .
            '/' .
            'arbeitsgemeinschaften.json';
    }

    private function apiEndpointUri()
    {
        return option('studyGroups.url');
    }

    private function apiKey()
    {
        return option('studyGroups.apiKey');
    }
}

?>
