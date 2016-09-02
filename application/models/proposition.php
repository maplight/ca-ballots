<?php

/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 7/25/16
 * Time: 11:25 AM
 */
class Proposition extends CI_Model
{


    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();

    }

    function get_propositions_by_election_date($date)
    {

        /*
         * TODO: VALIDATE THE INCOMING DATE
         */

        $results = array();

        $this->db->select('PropositionID, number, name,Election');
        $this->db->where(array('Election' => $date));
        $this->db->order_by("number", "asc");
        $query = $this->db->get('caballot_propositions');
        $results['propositions'] = $query->result();
        $results['propositions_count'] = count($results['propositions']);
        return $results;
    }


    function get_election_dates()
    {
        $results = array();

        $this->db->distinct();

        $this->db->select('Election');
        $this->db->order_by("Election", "desc");
        $query = $this->db->get('caballot_propositions');
        $results['proposition_elections'] = $query->result();
        $results['propositions_count'] = count($results['proposition_elections']);
        return $results;
    }


    function get_full_proposition_object_by_id($number, $election_year)
    {
        $results = array();


        $this->db->select('PropositionID,Name,Number,AmountYes,AmountNo,PercentYes,PercentNo');
        $this->db->where(array('Number' => $number, 'Election' => $election_year));
        $query = $this->db->get('caballot_propositions');
        $results['prop_obj']["money_raised"] = $query->result();


        $id = $results['prop_obj']["money_raised"][0]->PropositionID;
        $results['prop_obj']['name'] = $results['prop_obj']["money_raised"][0]->Name;
        $correct_case = "";

        if(isset( $results['prop_obj']['name'])){
            $name_parts = explode(".", $results['prop_obj']['name']);
            foreach($name_parts as $item){
                $correct_case .=ucfirst(strtolower(trim($item))) . ". ";
            }
        }

        $results['prop_obj']['name'] = str_replace(". . ",".",$correct_case);

        $results['prop_obj']['number'] = $results['prop_obj']["money_raised"][0]->Number;


        $this->db->select('*');
        $this->db->where(array('PropositionID' => $id));
        $query = $this->db->get('caballot_proposition_languages');
        $results['prop_obj']["text"] = $query->result();


        /*
       * Top 10 Contributors
       *
       */

        $this->db->select(' Position,DonorCounter,Donor,Amount, Date');
        $this->db->where(array('PropositionID' => $id, 'DonorCounter <=' => '5', 'DonorCounter !=' => '0'));
        $this->db->order_by("Counter", "asc");
        $query = $this->db->get('caballot_proposition_donors');
        if ($data = $query->result()) {
            foreach ($data as $item) {

                if($item->Date) {
                    $pieces = explode(" ", $item->Date)[0];
                    $date_parts = explode("-", $pieces);
                    $new_date_format = $date_parts[1] . "/" . $date_parts[2] . "/" . $date_parts[0];
                    $item->Date = $new_date_format;
                }

                $results['prop_obj']["top_contributors"][$item->Position][] = $item;
            }
        }


        return $results;

    }

}