
<footer>

    <?php 
        $environ = 'dev'; 
        // $environ = 'prod'; 
        
        $currentfilename = basename($_SERVER['PHP_SELF'], '.php');
        $languageList = ['Russian', 'French', 'Deutsch', 'Farsi', 'Turkish', 'Brizilian', 'Italian', 'English'];
        if (empty($templatelang) || !in_array($templatelang, $languageList)) {
            $templatelang = 'English';
        }

        echo '<script src="' . $PersonalRootDirectoryURL . '/modules/addons/cloudsnp/views/autovm/includes/assets/js/apexcharts.js"></script>';
        echo '<script src="' . $PersonalRootDirectoryURL . '/modules/addons/cloudsnp/views/autovm/includes/assets/js/lodash.min.js"></script>';
        echo '<script src="' . $PersonalRootDirectoryURL . '/modules/addons/cloudsnp/views/autovm/includes/assets/js/axios.min.js"></script>';
        echo('<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>');


        if($environ == 'dev'){
            echo('<script src="' . $PersonalRootDirectoryURL . '/modules/addons/cloudsnp/views/autovm/includes/assets/js/vue.global.js"></script>');
            echo "<script src=\"". $PersonalRootDirectoryURL . "/modules/addons/cloudsnp/views/autovm/includes/assets/js/lang/{$templatelang}.js?v=" . time() . '"></script>';
            echo '<script src="' . $PersonalRootDirectoryURL . '/modules/addons/cloudsnp/views/autovm/includes/assets/js/' . $currentfilename . 'app.js?v=' . time() . '"></script>';
        }


        if($environ == 'prod'){
            echo('<script src="' . $PersonalRootDirectoryURL . '/modules/addons/cloudsnp/views/autovm/includes/assets/js/vue.global.prod.js"></script>');
            echo("<script src='". $PersonalRootDirectoryURL . "/modules/addons/cloudsnp/views/autovm/includes/assets/js/lang/$templatelang.js'></script>");
            echo '<script src="' . $PersonalRootDirectoryURL . '/modules/addons/cloudsnp/views/autovm/includes/assets/js/' . $currentfilename . 'app.js?"></script>';
        }
        
    ?>

</footer>
</body>
</html>