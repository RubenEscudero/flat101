<?php

/**
 * Application
 */
class Test_Application extends Test_Application_Abstract {

    public function __construct() {
        Test_Session::init();
    }

    public static function InitSession() {
        return $session = new Test_Session();
    }
    
    public function run() {

        $session = $this->getSession();
        
        // Creamos el output de salida
        $tpl = new Test_Template('./resources/template.html');
        $tpl->addVariable('title', 'Prueba 1');

        $toCheck = array(
            'day' => array(
                'min' => 1,
                'max' => 31,
            ),
            'month' => array(
                'min' => 1,
                'max' => 12,
            ),
            'year' => array(
                'min' => 1900,
                'max' => date('Y'),
            ),
        );

        if (isset($_POST['form'])) {
            $form = $_POST['form'];

            foreach ($toCheck as $varName => $data) {
                if (!isset($form[$varName]) || $form[$varName] < $data['min'] || $form[$varName] > $data['max']) {
                    return $this->showError("Has introducido mal el valor: $varName");
                }
            }

            $birthDay = mktime(0, 0, 0, $_POST['form']['month'], $_POST['form']['day'], $_POST['form']['year']);

            $stats = json_decode(file_get_contents('./resources/toshow.json'), true);

            $nextPosition = $session->get('stat_pos', 0);
            
            if(!isset($stats[$nextPosition])) {
                $nextPosition = 0;
            }

            $randomStat = 'Test_Stats_' . $stats[$nextPosition];
            $randomStat = new $randomStat($birthDay);

            $nextPosition++;

            if ($nextPosition >= count($stats)) {
                $session->remove('stat_pos');
            } else {
                $session->set('stat_pos', $nextPosition);
            }

            $this->showStats($tpl, $randomStat, $birthDay);

        } else {
            $this->showForm($tpl);
        }

    }

    protected function showForm(Test_Template $tpl) {
        $tplForm = new Test_Template('./resources/template/form.html');
        $tpl->addVariable('content', $tplForm);

        echo $tpl;
    }
    
    protected function showStats(Test_Template $tpl, Test_Stats_Abstract $randomStat, $birthDay) {
        $tplStats = new Test_Template('./resources/template/stats.html');

        $tplStats->addVariable('text', $randomStat->getText());
        $tplStats->addVariable('image', $randomStat->getImage());
        $tplStats->addVariable('date', date('d/m/Y', $birthDay));

        $tpl->addVariable('content', $tplStats);
        
        echo $tpl;
    }
    
    protected function showError($msg) {
        $tpl = new Test_Template('./resources/error.html');
        $tpl->addVariable('message', $msg);
        
        echo $tpl;
    }

}