
        <footer>
            <!-- Fotter file -->
            <!-- scripts vue -->
            <script src="/modules/addons/cloud/views/autovm/includes/assets/js/apexcharts.js"></script>
            <script src="/modules/addons/cloud/views/autovm/includes/assets/js/lodash.min.js"></script>
            <script src="/modules/addons/cloud/views/autovm/includes/assets/js/axios.min.js"></script>
            <script src="/modules/addons/cloud/views/autovm/includes/assets/js/vue.global.js"></script>
            
            

            <!-- Language file -->
            <?php if ($templatelang == 'ru'): ?>
                <script src="/modules/addons/cloud/views/autovm/includes/assets/js/lang/ru.js"></script>
            <?php elseif ($templatelang == 'fr'): ?>
                <script src="/modules/addons/cloud/views/autovm/includes/assets/js/lang/fr.js"></script>
            <?php elseif ($templatelang == 'du'): ?>
                <script src="/modules/addons/cloud/views/autovm/includes/assets/js/lang/du.js"></script>
            <?php elseif ($templatelang == 'fa'): ?>
                <script src="/modules/addons/cloud/views/autovm/includes/assets/js/lang/fa.js"></script>
            <?php elseif($templatelang == 'tr'): ?> 
                <script src="/modules/addons/cloud/views/autovm/includes/assets/js/lang/tr.js"></script>
            <?php elseif($templatelang == 'en'): ?> 
                <script src="/modules/addons/cloud/views/autovm/includes/assets/js/lang/defaulten.js"></script>
            <?php else: ?> 
                <script src="/modules/addons/cloud/views/autovm/includes/assets/js/lang/defaulten.js"></script>
            <?php endif ?>
            
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            
            <?php       
                $currentfilename = basename($_SERVER['PHP_SELF'], '.php');
                switch ($currentfilename) {
                    case 'create':
                        echo '<script src="/modules/addons/cloud/views/autovm/includes/assets/js/createapp.js"></script>';
                        break;
                    case 'index':
                        echo '<script src="/modules/addons/cloud/views/autovm/includes/assets/js/indexapp.js"></script>';
                        break;
                    case 'machine':
                        echo '<script src="/modules/addons/cloud/views/autovm/includes/assets/js/machineapp.js"></script>';
                        break;
                    case 'adminpanel':
                        echo '<script src="/modules/addons/cloud/views/autovm/includes/assets/js/adminapp.js"></script>';
                        break;
                    }
            ?>

        </footer>
    </body>
</html>
