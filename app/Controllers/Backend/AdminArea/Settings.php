<?php

namespace App\Controllers\Backend\AdminArea;

use App\Models\SettingModel;
use Core\Controller;
use Exception;
use Illuminate\Support\Str;

class Settings extends Controller
{

    public function index()
    {
        return $this->view("backend.adminArea.settings.index");
    }

    public function updateSettings()
    {

        try {

            $_POST["smtp_password"] = base64_encode($_POST["smtp_password"]);

            $update = SettingModel::where("id", "=", "0")->update($_POST);

            if ($update):
                echo "success";
            else:
                echo "no_change";
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    public function updateImage()
    {

        @$logo_type = $_FILES["logo"]["type"];
        @$logo_tmp_name = $_FILES["logo"]["tmp_name"];
        @$logo_name = $_FILES["logo"]["name"];
        @$logo_size = $_FILES['logo']['size'];

        @$favicon_type = $_FILES["favicon"]["type"];
        @$favicon_tmp_name = $_FILES["favicon"]["tmp_name"];
        @$favicon_name = $_FILES["favicon"]["name"];
        @$favicon_size = $_FILES['favicon']['size'];

        try {

            $settings = SettingModel::find(0);

            if ($logo_size == 0 && $favicon_size == 0) :
                echo 'file_not_selected';
                die();
            else :

                if ($logo_size != 0) :
                    if ($logo_size > (1024 * 1024 * 10)) :
                        echo "logo_is_too_big";
                        die();
                    else :
                        if ($logo_type == "image/png" || $logo_type == "image/jpeg" || $logo_type == "image/jpg") :

                            $old_logo = __mainDIR__ . $settings->logo;
                            $logoPath = "/public/assets/uploads/logos/";
                            $newLogofileName = $logoPath . uniqid() . "_" . substr(Str::slug($logo_name), 0, -3) . "." . substr($logo_name, -3);

                            $logoUpdate = SettingModel::where("id", "=", "0")->update(['logo' => $newLogofileName]);

                            if ($logoUpdate):

                                if (file_exists(__mainDIR__ . $logoPath)):
                                    if (file_exists($old_logo)):
                                        unlink($old_logo);
                                    endif;
                                else:
                                    mkdir(__mainDIR__ . $logoPath, 0777);
                                endif;
                                @move_uploaded_file($logo_tmp_name, __mainDIR__ . $newLogofileName);

                            else:

                                echo "failed";
                                die();

                            endif;

                        else :

                            echo "logo_type_not_supported";
                            die();

                        endif;
                    endif;
                endif;

                if ($favicon_size != 0) :
                    if ($favicon_size > (1024 * 1024 * 10)) :
                        echo "favicon_is_too_big";
                        die();
                    else :
                        if ($favicon_type == "image/png" || $favicon_type == "image/jpeg" || $favicon_type == "image/jpg") :

                            $old_favicon = __mainDIR__ . $settings->favicon;
                            $faviconPath = "/public/assets/uploads/logos/";
                            $newFaviconfileName = $faviconPath . uniqid() . "_" . substr(Str::slug($favicon_name), 0, -3) . "." . substr($favicon_name, -3);

                            $faviconUpdate = SettingModel::where("id", "=", "0")->update(['favicon' => $newFaviconfileName]);

                            if ($faviconUpdate):

                                if (file_exists(__mainDIR__ . $faviconPath)):
                                    if (file_exists($old_favicon)):
                                        unlink($old_favicon);
                                    endif;
                                else:
                                    mkdir(__mainDIR__ . $faviconPath, 0777);
                                endif;
                                @move_uploaded_file($favicon_tmp_name, __mainDIR__ . $newFaviconfileName);

                            else:

                                echo "failed";
                                die();

                            endif;

                        else :

                            echo "favicon_type_not_supported";
                            die();

                        endif;
                    endif;
                endif;

                if (isset($logoUpdate) || isset($faviconUpdate)):
                    echo 'success';
                    die();
                else:
                    echo 'failed';
                    die();
                endif;

            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }

    }

    public function updateRecaptcha(){

        try {

            $update = SettingModel::where("id", "=", "0")->update($_POST);

            if ($update):
                echo "success";
            else:
                echo "no_change";
            endif;

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }
}