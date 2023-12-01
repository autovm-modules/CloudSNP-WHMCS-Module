
<footer>
    <script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/apexcharts.js"></script>
    <script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/lodash.min.js"></script>
    <script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/axios.min.js"></script>

    
            
            
<?php 
    $environ = 'dev'; 
    // $environ = 'prod'; 
    



    
    if($environ == 'dev'){
        echo('<script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/vue.global.js"></script>');
        echo('<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>');


        $languageList = ['Russian', 'French', 'Deutsch', 'Farsi', 'Turkish', 'Brizilian', 'Italian', 'English'];
        if(empty($templatelang)){ $templatelang = 'English'; } 
        if (in_array($templatelang, $languageList)) {
            echo "<script src=\"/modules/addons/cloudsnp/views/autovm/includes/assets/js/lang/{$templatelang}.js?v=" . time() . '"></script>';
        } else {
            echo "<script src=\"/modules/addons/cloudsnp/views/autovm/includes/assets/js/lang/English.js?v=" . time() . '"></script>';
        }


        $currentfilename = basename($_SERVER['PHP_SELF'], '.php');
        switch ($currentfilename) {
            case 'create':
                echo '<script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/createapp.js?v=' . time() . '"></script>';
                break;
            case 'index':
                echo '<script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/indexapp.js?v=' . time() . '"></script>';
                break;
            case 'machine':
                echo '<script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/machineapp.js?v=' . time() . '"></script>';
                break;
            case 'adminpanel':
                echo '<script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/adminapp.js?v=' . time() . '"></script>';
                break;
        }
    }









    if($environ == 'prod'){
        echo('<script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/vue.global.prod.js"></script>');
        echo('<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>');


        $languageList = ['Russian', 'French', 'Deutsch', 'Farsi', 'Turkish', 'Brizilian', 'Italian', 'English'];
        if(empty($templatelang)){ $templatelang = 'English'; } 
        if (in_array($templatelang, $languageList)) {
            echo("<script src='/modules/servers/product/views/view/assets/js/lang/$templatelang.js'></script>");
            echo "<script src=\"/modules/addons/cloudsnp/views/autovm/includes/assets/js/lang/{$templatelang}.js\"></script>";
        } else {
            echo("<script src='/modules/servers/product/views/view/assets/js/lang/English.js'></script>");
            echo "<script src=\"/modules/addons/cloudsnp/views/autovm/includes/assets/js/lang/English.js\"></script>";
        }


        $currentfilename = basename($_SERVER['PHP_SELF'], '.php');
        switch ($currentfilename) {
            case 'create':
                echo '<script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/createapp.js?"></script>';
                break;
            case 'index':
                echo '<script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/indexapp.js?"></script>';
                break;
            case 'machine':
                echo '<script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/machineapp.js?"></script>';
                break;
            case 'adminpanel':
                echo '<script src="/modules/addons/cloudsnp/views/autovm/includes/assets/js/adminapp.js?"></script>';
                break;
        }
    }
        
                
              
                
                
                
                ?>

        </footer>
    </body>
</html>