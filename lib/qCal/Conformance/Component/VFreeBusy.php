<?php
/**
 * VFREEBUSY Component Conformance
 *
 * RFC 5545 Definition
 * 
 * When used to request free/busy time information, the "ATTENDEE"
 * property specifies the calendar users whose free/busy time is being
 * requested; the "ORGANIZER" property specifies the calendar user who
 * is requesting the free/busy time; the "DTSTART" and "DTEND"
 * properties specify the window of time for which the free/busy time is
 * being requested; the "UID" and "DTSTAMP" properties are specified to
 * assist in proper sequencing of multiple free/busy time requests.
 * 
 * When used to reply to a request for free/busy time, the "ATTENDEE"
 * property specifies the calendar user responding to the free/busy time
 * request; the "ORGANIZER" property specifies the calendar user that
 * originally requested the free/busy time; the "FREEBUSY" property
 * specifies the free/busy time information (if it exists); and the
 * 
 * "UID" and "DTSTAMP" properties are specified to assist in proper
 * sequencing of multiple free/busy time replies.
 * 
 * When used to publish busy time, the "ORGANIZER" property specifies
 * the calendar user associated with the published busy time; the
 * "DTSTART" and "DTEND" properties specify an inclusive time window
 * that surrounds the busy time information; the "FREEBUSY" property
 * specifies the published busy time information; and the "DTSTAMP"
 * property specifies the date/time that iCalendar object was created.
 * 
 * The "VFREEBUSY" calendar component cannot be nested within another
 * calendar component. Multiple "VFREEBUSY" calendar components can be
 * specified within an iCalendar object. This permits the grouping of
 * Free/Busy information into logical collections, such as monthly
 * groups of busy time information.
 * 
 * The "VFREEBUSY" calendar component is intended for use in iCalendar
 * object methods involving requests for free time, requests for busy
 * time, requests for both free and busy, and the associated replies.
 * 
 * Free/Busy information is represented with the "FREEBUSY" property.
 * This property provides a terse representation of time periods. One or
 * more "FREEBUSY" properties can be specified in the "VFREEBUSY"
 * calendar component.
 * 
 * When present in a "VFREEBUSY" calendar component, the "DTSTART" and
 * "DTEND" properties SHOULD be specified prior to any "FREEBUSY"
 * properties. In a free time request, these properties can be used in
 * combination with the "DURATION" property to represent a request for a
 * duration of free time within a specified window of time.
 * 
 * The recurrence properties ("RRULE", "EXRULE", "RDATE", "EXDATE") are
 * not permitted within a "VFREEBUSY" calendar component. Any recurring
 * events are resolved into their individual busy time periods using the
 * "FREEBUSY" property.
 * 
 * Example: The following is an example of a "VFREEBUSY" calendar
 * component used to request free or busy time information:
 * 
 *   BEGIN:VFREEBUSY
 *   ORGANIZER:MAILTO:jane_doe@host1.com
 *   ATTENDEE:MAILTO:john_public@host2.com
 *   DTSTART:19971015T050000Z
 *   DTEND:19971016T050000Z
 *   DTSTAMP:19970901T083000Z
 *   END:VFREEBUSY
 * 
 * The following is an example of a "VFREEBUSY" calendar component used
 * to reply to the request with busy time information:
 * 
 *   BEGIN:VFREEBUSY
 *   ORGANIZER:MAILTO:jane_doe@host1.com
 *   ATTENDEE:MAILTO:john_public@host2.com
 *   DTSTAMP:19970901T100000Z
 *   FREEBUSY;VALUE=PERIOD:19971015T050000Z/PT8H30M,
 *	19971015T160000Z/PT5H30M,19971015T223000Z/PT6H30M
 *   URL:http://host2.com/pub/busy/jpublic-01.ifb
 *   COMMENT:This iCalendar file contains busy time information for
 *	 the next three months.
 *   END:VFREEBUSY
 * 
 * The following is an example of a "VFREEBUSY" calendar component used
 * to publish busy time information.
 * 
 *   BEGIN:VFREEBUSY
 *   ORGANIZER:jsmith@host.com
 *   DTSTART:19980313T141711Z
 *   DTEND:19980410T141711Z
 *   FREEBUSY:19980314T233000Z/19980315T003000Z
 *   FREEBUSY:19980316T153000Z/19980316T163000Z
 *   FREEBUSY:19980318T030000Z/19980318T040000Z
 *   URL:http://www.host.com/calendar/busytime/jsmith.ifb
 *   END:VFREEBUSY
 * 
 * @package     qCal
 * @subpackage  qCal\Conformance
 * @author      Luke Visinoni <luke.visinoni@gmail.com>
 * @copyright   (c) 2014 Luke Visinoni <luke.visinoni@gmail.com>
 * @license     GNU Lesser General Public License v3 (see LICENSE file)
 */
namespace qCal\Conformance\Component;
use \qCal\Element;

class VFreeBusy extends \qCal\Conformance\Component {

    /**
     * @var array Required properties
     */
    protected $reqProperties = array();
    
    /**
     * @var array A list of allowed parent components
     */
    protected $allowedParents = array('VCALENDAR');
    
    /**
     * Check that this component is conformant
     * @param qCal\Element\Component
     * @todo I just wanted to get this working so I hastily threw this together.
     *       Once I have some time to spend on it, refactor and make this neater
     *       Extract as much functionality as possible up into the parent class
     */
    public function conform(Element\Component\VFreeBusy $cmpnt) {
    
        // despite the long description for VFREEBUSY components, I can't find
        // any conformance rules
        return parent::conform($cmpnt);
    
    }

}