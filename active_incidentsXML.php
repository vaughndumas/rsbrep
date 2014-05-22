<?php

global $dom, $rowset;


function process_single($x_datarec, $rowset, $dom) {

    $row = $rowset->appendChild($dom->createElement('ROW'));
    $row->setAttribute('number', "1");
    $newelement = $row->appendChild($dom->createElement('incidentNumber'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_number']));

    $newelement = $row->appendChild($dom->createElement('sys_id'));
    $newelement->appendChild($dom->createTextNode($x_datarec['sys_id']));

    $newelement = $row->appendChild($dom->createElement('shortDescription'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_short_description']));

    $newelement = $row->appendChild($dom->createElement('requestedBy'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_u_requestor']));

    $newelement = $row->appendChild($dom->createElement('openedOn'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_opened_at']));

    $newelement = $row->appendChild($dom->createElement('openedBy'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_opened_by']));

    $newelement = $row->appendChild($dom->createElement('serviceProvider'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_u_service_provider']));    

    $newelement = $row->appendChild($dom->createElement('category'));
    $newelement->appendChild($dom->createTextNode($x_datarec['category']));

    $newelement = $row->appendChild($dom->createElement('statusName'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_state']));

    $newelement = $row->appendChild($dom->createElement('statusCode'));
    $newelement->appendChild($dom->createTextNode($x_datarec['state']));

    $newelement = $row->appendChild($dom->createElement('assignedTo'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_assigned_to']));

    $newelement = $row->appendChild($dom->createElement('updatedOn'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_sys_updated_on']));

    $newelement = $row->appendChild($dom->createElement('updatedBy'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_sys_updated_by']));

    $newelement = $row->appendChild($dom->createElement('contactType'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_contact_type']));

    $newelement = $row->appendChild($dom->createElement('priority'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_priority']));

    $newelement = $row->appendChild($dom->createElement('impact'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_impact']));

    $newelement = $row->appendChild($dom->createElement('escalation'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_escalation']));

    $newelement = $row->appendChild($dom->createElement('serviceProvider'));
    $newelement->appendChild($dom->createTextNode($x_datarec['dv_u_service_provider']));
}

function process_multi($x_datarec, $rowset, $dom) {
    $v_rowcount = 0;
    foreach ($x_datarec as $v_datakey => $v_datavalue) {
        $v_rowcount++;
        $row = $rowset->appendChild($dom->createElement('ROW'));
        $row->setAttribute('number', "{$v_rowcount}");
        
        $newelement = $row->appendChild($dom->createElement('incidentNumber'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_number']));

        $newelement = $row->appendChild($dom->createElement('sys_id'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['sys_id']));

        $newelement = $row->appendChild($dom->createElement('shortDescription'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_short_description']));

        $newelement = $row->appendChild($dom->createElement('requestedBy'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_u_requestor']));

        $newelement = $row->appendChild($dom->createElement('openedOn'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_opened_at']));

        $newelement = $row->appendChild($dom->createElement('openedBy'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_opened_by']));

        $newelement = $row->appendChild($dom->createElement('serviceProvider'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_u_service_provider']));    

        $newelement = $row->appendChild($dom->createElement('category'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_category']));

        $newelement = $row->appendChild($dom->createElement('statusName'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_state']));

        $newelement = $row->appendChild($dom->createElement('statusCode'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['state']));

        $newelement = $row->appendChild($dom->createElement('assignedTo'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_assigned_to']));

        $newelement = $row->appendChild($dom->createElement('updatedOn'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_sys_updated_on']));

        $newelement = $row->appendChild($dom->createElement('updatedBy'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_sys_updated_by']));

        $newelement = $row->appendChild($dom->createElement('contactType'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_contact_type']));

        $newelement = $row->appendChild($dom->createElement('priority'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_priority']));

        $newelement = $row->appendChild($dom->createElement('impact'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_impact']));

        $newelement = $row->appendChild($dom->createElement('escalation'));
        $newelement->appendChild($dom->createTextNode($v_datavalue['dv_escalation']));
    }
}

$dom = new DOMDocument("1.0");
$rowset = $dom->appendChild($dom->createElement('ROWSET'));

/*
 * Generate an XMLDOM for the request
 * This will normally be called from an AJAX call
 */
$v_wsurl = "https://itservicedesk.anu.edu.au/incident.do?displayvalue=all&WSDL";
$v_client = new SoapClient($v_wsurl, array(
    "login" => "A371615",
    "password" => "rsb123",
    "tableName" => "incident"
        )
);

$v_result = $v_client->__soapCall("getRecords", array("getRecords" => array("active" => "true",
                                                                            "u_service_provider" => "CMBE - RSB IT",
        "uri" => "http://www.servicenow.com/incident")));


/* Check if a single or multiple records have been retrieved.
 * Unfortunately the structure of each is different so needs to be processed
 * differently.
 */

$v_recarray = objectToArray($v_result->getRecordsResult);

if (!is_array($v_result->getRecordsResult)) {
    process_single($v_recarray, $rowset, $dom);
} else {
    process_multi($v_recarray, $rowset, $dom);
}

$dom->formatOutput = true;
header("Content-type: text/xml");
echo $dom->saveXML();



function objectToArray($d) {
    if (is_object($d)) {
        $d = get_object_vars($d);
    }
    if (is_array($d)) {
        return array_map(__FUNCTION__, $d);
    } else {
        return $d;
    }
}

?>
