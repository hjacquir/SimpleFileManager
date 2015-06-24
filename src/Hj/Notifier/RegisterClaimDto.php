<?php

/**
 * Created by Hatim Jacquir
 * @author : Hatim Jacquir <jacquirhatim@gmail.com>
 */

namespace Hj\Notifier;

use DateTime;

/**
 * Class RegisterClaimDto
 * @package Hj\Notifier
 */
class RegisterClaimDto
{
    /**
     * @var integer
     */
    private $policyId;

    /**
     * @var DateTime
     */
    private $incidentDate;

    /**
     * @var string
     */
    private $type;

    /**
     * @param \DateTime $incidentDate
     */
    public function setIncidentDate($incidentDate)
    {
        $this->incidentDate = $incidentDate;
    }

    /**
     * @return \DateTime
     */
    public function getIncidentDate()
    {
        return $this->incidentDate;
    }

    /**
     * @param int $policyId
     */
    public function setPolicyId($policyId)
    {
        $this->policyId = $policyId;
    }

    /**
     * @return int
     */
    public function getPolicyId()
    {
        return $this->policyId;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}