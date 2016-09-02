<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Propositions extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->model('proposition');
        $election_date = "2016-11-08";
        $this->load_propositions($election_date);
    }

    public function view_election($election_date) {
        $data['election_date'] = $election_date;

        $d = DateTime::createFromFormat('Y-m-d', $election_date);
        $isValidDate = $d && $d->format('Y-m-d') === $election_date;

        if ($isValidDate) {
            $this->load_propositions($election_date);
        }
        else {
            // log an error here
        }
    }

    public function view_proposition($election_date, $proposition_number) {
        $data['election_date'] = $election_date;
        $data['proposition_number'] = $proposition_number;

        $this->load->model('proposition');
        $data['propositions'] = $this->proposition->get_propositions_by_election_date($election_date);
        $data['proposition'] = $this->proposition->get_full_proposition_object_by_id($proposition_number, $election_date)['prop_obj'];




        $this->load->view('header');
        $this->load->view('proposition', $data);
        $this->load->view('footer');
    }

    private function load_propositions($election_date) {
        $this->load->model('proposition');
        $data['propositions'] = $this->proposition->get_propositions_by_election_date($election_date);
        $data['elections'] = $this->proposition->get_election_dates();
        $data['election_date'] = $election_date;

       $this->load->view('header');
       $this->load->view('propositions', $data);
       $this->load->view('footer');
    }

    public function view_contributions($election_date, $proposition_number, $yesOrNo)
    {
        $data['election_date'] = $election_date;
        $data['proposition_number'] = $proposition_number;
        $data['yesOrNo'] = $yesOrNo;

        $this->load->model('test_model');
        $data["contributions"] = $this->test_model->get_last_ten_contributions();

        $this->load->view('header');
        $this->load->view('contributions', $data);
        $this->load->view('footer');
    }


    public function get_propositions($date = '2016-11-08'){


        $this->load->model('proposition');
        $data = $this->proposition->get_propositions_by_election_date($date);

        header('Content-type: application/json');
        echo json_encode($data);
    }


    public function propositions_election_dates(){
        $this->load->model('proposition');
        $data = $this->proposition->get_election_dates();

        header('Content-type: application/json');
        echo json_encode($data);

    }

    public function prop_obj_test($number, $eleciton_year){
        $this->load->model('proposition');
        $data = $this->proposition->get_full_proposition_object_by_id($number, $eleciton_year);

        header('Content-type: application/json');
        echo json_encode($data);

    }


}

/* End of file welcome.php */
/* Location: ./applica */