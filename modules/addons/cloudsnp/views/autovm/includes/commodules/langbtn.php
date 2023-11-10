<div class="dropdown m-0 p-0 ">
<span class="border-0 p-2 px-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="--bs-bg-opacity: 1.0"><i class="bi bi-translate"></i>
    <?php 
        switch ($templatelang) {
            case "Farsi":
            echo "فارسی";
            break;

            case "English":
            echo "English";
            break;

            case "Turkish":
            echo "Türkçe";
            break;

            case "French":
            echo "French";
            break;

            case "Deutsch":
            echo "Deutsch ";
            break;

            case "Russian":
            echo "Russian";
            break;
            
            case "Brizilian":
            echo "Brizilian";
            break;
            
            case "Italian":
            echo "Italian";
            break;

            default:
            echo "!!!";
        }
        ?>
    </span>
    <div class="dropdown-menu border-1 shadow-lg p-4" style="min-width: 300px !important;">
        <p class="fs-6">{{ lang('chooselanguage') }}</p>    
        <div>
            <select name="language" class="form-select" aria-label="Default select example" v-model="PanelLanguage">
                <option value="English" <?php if( $templatelang == 'English'){echo 'selected';} ?>> English </option>
                <option value="Farsi" <?php if( $templatelang == 'Farsi'){echo 'selected';} ?>> فارسی </option>
                <option value="Turkish" <?php if( $templatelang == 'Turkish'){echo 'selected';} ?>> Türkçe </option>
                <option value="French" <?php if( $templatelang == 'French'){echo 'selected';} ?>> Français </option>
                <option value="Deutsch" <?php if( $templatelang == 'Deutsch'){echo 'selected';} ?>> Deutsch </option>
                <option value="Russian" <?php if( $templatelang == 'Russian'){echo 'selected';} ?>> Pусский </option>
                <option value="Brizilian" <?php if( $templatelang == 'Brizilian'){echo 'selected';} ?>> Brizilian </option>
                <option value="Italian" <?php if( $templatelang == 'Italian'){echo 'selected';} ?>> Italian </option>
            </select>
            <input type="hidden" name="thisid" value="<?php echo $_GET['id'] ?? ''; ?>">

            <button class="btn btn-primary mt-3 float-end" @click="changeLanguage()">{{ lang('setlanguage') }}</button>
        </div>
    </div>
</div>
