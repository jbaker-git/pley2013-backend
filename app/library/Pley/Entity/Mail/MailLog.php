<?php /** @copyright Pley (c) 2014, All Rights Reserved */
namespace Pley\Entity\Mail;

use \PleyWorld\Entity\Exception\ImmutableAttributeException;

/**
 * The <kbd>MailLog</kbd> entity class.
 *
 * @author Alejandro Salazar (alejandros@pley.com)
 * @version 2.0
 * @package Pley.Entity.Mail
 * @subpackage Entity
 */
class MailLog
{
    /** @var int */
    protected $_id;
    /** @var int */
    protected $_userId;
    /** @var int */
    protected $_templateId;
    /** @var string */
    protected $_mailTo;
    /** @var string */
    protected $_mailFrom;
    /** @var string */
    protected $_mailOnBehalfOf;
    /** @var array */
    protected $_refData;
    /** @var date */
    protected $_createdAt;
    
    /**
     * Creates a new MailLog for addition.
     * @param int    $userId
     * @param int    $mailTemplateId
     * @param string $mailTo
     * @param string $mailFrom
     * @param string $mailOnBehalfOf
     * @param array  $refData
     * @return \Pley\Entity\Mail\MailLog
     */
    public static function withNew(
            $userId, $mailTemplateId, $mailTo, $mailFrom, $mailOnBehalfOf, $refData)
    {
        $createdAt = null;
        
        return new static(
            null, $userId, $mailTemplateId, $mailTo, $mailFrom, $mailOnBehalfOf, $refData,
            $createdAt
        );
    }
    
    public function __construct(
            $id, $userId, $templateId, $mailTo, $mailFrom, $mailOnBehalfOf, $refData, $createdAt)
    {
        $this->_id             = $id;
        $this->_userId         = $userId;
        $this->_templateId     = $templateId;
        $this->_mailTo         = $mailTo;
        $this->_mailFrom       = $mailFrom;
        $this->_mailOnBehalfOf = $mailOnBehalfOf;
        $this->_refData        = $refData;
        $this->_createdAt      = $createdAt;
    }

    /**
     * The Mail log id
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /** @param int id */
    public function setId($id)
    {
        if (isset($this->_id)) {
            throw new ImmutableAttributeException(static::class, '_id');
        }
        $this->_id = $id;
    }

    /**
     * The User ID to which this email was sent to (if user was registered)
     * @return int Integer if target user was registered, <kbd>null</kbd> otherwise.
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * The template ID used for this email
     * @return int
     */
    public function getTemplateId()
    {
        return $this->_templateId;
    }

    /**
     * The email address of the user which we sent this email to.
     * @return string
     */
    public function getMailTo()
    {
        return $this->_mailTo;
    }

    /**
     * The email address of our system that we used to send this email.
     * @return string
     */
    public function getMailFrom()
    {
        return $this->_mailFrom;
    }

    /**
     * The email address of of a user that triggered this email to another user.
     * <p>Emails are sent from our system, but we record that we sent it on behalf of this user,
     * an example is gifts send from user A to user B.</p>
     * <p>If the email is generated by our system, this field will be <kbd>null</kbd>.</p>
     * 
     * @return string String if this email was sent on behalf of another user, <kbd>null</kbd> otherwise.
     */
    public function getMailOnBehalfOf()
    {
        return $this->_mailOnBehalfOf;
    }

    /**
     * Data map with information needed in case we need to resend this email and thus be able to
     * initialize Objects needed by the Email Templates when filling out Tag varaibles.
     * <p>If the map is not empty, a list of entries that identify the tag id and the entity id
     * for such tag.</p>
     * <p>An example would look like:<br/>
     * <pre>array(
     * &nbsp;   // User Reference
     * &nbsp;   array('tag' => 1, 'id' => 4783), 
     * &nbsp;
     * &nbsp;   // Designer Reference
     * &nbsp;   array('tag' => #, 'id' => 12345), 
     * )</pre></p>
     * 
     * @return array
     */
    public function getRefData()
    {
        return $this->_refData;
    }
    
    public function getCreatedAt()
    {
        return $this->_createdAt;
    }

}
