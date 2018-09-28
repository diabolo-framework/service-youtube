<?php
namespace X\Service\Youtube;
use X\Core\Service\XService;
class Service extends XService {
    /** @var array */
    protected $projects = array();
    /** @var YoutubeProject[] */
    private $projectCache = array();
    
    /**
     * @param string $project
     * @throws YoutubeException
     * @return \X\Service\Youtube\YoutubeProject
     */
    public function getProject( $project ) {
        if ( $project instanceof YoutubeProject ) {
            return $project;
        }
        if ( !isset($this->projects[$project]) ) {
            throw new YoutubeException("unable to find project `{$project}`");
        }
        if ( !isset($this->projectCache[$project]) ) {
            $this->projectCache[$project] = new YoutubeProject($this->projects[$project]);
        }
        return $this->projectCache[$project];
    }
}