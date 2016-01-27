<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BrowserVersion
 *
 * @ORM\Table(name="browser_version")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BrowserVersionRepository")
 */
class BrowserVersion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Browser
     *
     * @ORM\ManyToOne(targetEntity="Browser")
     * @ORM\JoinColumn(name="browser_id", referencedColumnName="id")
     */
    private $browser;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set browser
     *
     * @param integer $browser
     * @return BrowserVersion
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * Get browser
     *
     * @return integer 
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return BrowserVersion
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }
}
