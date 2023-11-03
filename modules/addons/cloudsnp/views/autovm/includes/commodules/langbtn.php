<div class="dropdown m-0 p-0 ">
    <span class="border-0 p-2 px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="--bs-bg-opacity: 1.0"><i class="bi bi-translate"></i>
        <?php 
        switch ($templatelang) {
            case "fa":
            echo "فارسی";
            break;

            case "en":
            echo "en";
            break;

            case "tr":
            echo "Türkçe";
            break;

            case "fr":
            echo "French";
            break;

            case "du":
            echo "Deutsch ";
            break;

            case "ru":
            echo "Russian";
            break;

            default:
            echo "!!!";
        }
        ?>
    </span>
    <div class="dropdown-menu border-1 shadow-lg p-4" style="min-width: 300px !important;">
        <p class="fs-6">{{ lang('chooselanguage') }}</p>    
        
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <select name="language" class="form-select" aria-label="Default select example">
                <option value="en" <?php if( $templatelang == 'en'){echo 'selected';} ?>> English </option>
                <option value="fa" <?php if( $templatelang == 'fa'){echo 'selected';} ?>> فارسی </option>
                <option value="tr" <?php if( $templatelang == 'tr'){echo 'selected';} ?>> Türkçe </option>
                <option value="fr" <?php if( $templatelang == 'fr'){echo 'selected';} ?>> Français </option>
                <option value="du" <?php if( $templatelang == 'du'){echo 'selected';} ?>> Deutsch </option>
                <option value="ru" <?php if( $templatelang == 'ru'){echo 'selected';} ?>> Pусский </option>
            </select>
            <input type="hidden" name="thisid" value="<?php echo $_GET['id'] ?? ''; ?>">

            <button class="btn btn-primary mt-3 float-end" type="submit">{{ lang('setlanguage') }}</button>
        </form>
    </div>
</div>
