<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {

        if($user->username === null){
            return redirect(route('logout'));
        }

        $result_query_Get_user = $this->query_Get_User($user->username);

        if(empty($result_query_Get_user)){
            $this->displayError();
            exit();
        }

        $username = $result_query_Get_user->username;
        $fullname = $result_query_Get_user->fullname;
        $user_level_id = $result_query_Get_user->user_level_id;
        $level_desc = $result_query_Get_user->level_desc;
        $user_view = $result_query_Get_user->user_view;
        $user_edit = $result_query_Get_user->user_edit;
        $user_delete = $result_query_Get_user->user_delete;
        $user_create = $result_query_Get_user->user_create;
        if(
            empty($username) ||
            empty($fullname) ||
            empty($user_level_id)
        ){
            $this->displayError();
            exit();
        }

        $result_get_Sidebar = $this->get_Sidebar($username);
        if(empty($result_get_Sidebar)){
            $this->displayError();
            exit();
        }

        $result_get_User_access = $this->get_User_Access($username);
        if(empty($result_get_User_access)){
            $this->displayError();
            exit();
        }

        $result_get_Client_Project = $this->get_Client_Project($username);
        if(empty($result_get_Client_Project)){
            $this->displayError();
            exit();
        }
        $request->session()->put('username', $username);
        $request->session()->put('fullname', $fullname);
        $request->session()->put('user_level_id', $user_level_id);
        $request->session()->put('level_desc', $level_desc);
        $request->session()->put('user_view', $user_view);
        $request->session()->put('user_edit', $user_edit);
        $request->session()->put('user_delete', $user_delete);
        $request->session()->put('user_create', $user_create);
        $request->session()->put('sidebar', $result_get_Sidebar);
        $request->session()->put('user_access', $result_get_User_access);
        $request->session()->put('arr_client_project', $result_get_Client_Project);
        $request->session()->put('current_client_project_id', @$result_get_Client_Project[0]->client_project_id);
        $request->session()->put('current_client_id', @$result_get_Client_Project[0]->client_id);
        $request->session()->put('current_warehouse_id', @$result_get_Client_Project[0]->wh_id);
        $request->session()->put('current_client_project_name', @$result_get_Client_Project[0]->client_project_name);
        $request->session()->put('current_client_name', @$result_get_Client_Project[0]->client_name);
        $request->session()->put('current_warehouse_name', @$result_get_Client_Project[0]->wh_name);
    }

    private function query_Get_User($username)
    {
        $query = DB::query()
        ->select([
            "t_wh_user.username",
            "t_wh_user.fullname",
            "t_wh_user.user_level_id",
            "m_wh_user_level.level_desc",
            "m_wh_user_level.user_view",
            "m_wh_user_level.user_edit",
            "m_wh_user_level.user_delete",
            "m_wh_user_level.user_create",
        ])
        ->from("t_wh_user")
        ->leftJoin("m_wh_user_level","m_wh_user_level.user_level_id","=","t_wh_user.user_level_id")
        ->where("t_wh_user.username",$username)
        ->limit(1)
        ->get()
        ;

        if(count($query) == 0){
            return false;
        }

        return $query[0];
    }

    private function get_Sidebar($username)
    {
        //condition 1 : kalo menu_url ada jadiin kek dashboard
        //condition 2 : kalo menu_url ga ada dan punya anak jadiin kek Inbound
        //condition 3 : kalo menu_url  ga ada dan ga punya anak jangan di tampilin
        $html = "";
        $parrent_menu = $this->query_Get_Menu_by_parent_id_and_username(0,$username);

        if(count($parrent_menu) > 0){
            foreach ($parrent_menu as $key_parrent_menu => $value_parrent_menu) {
                $child_menu = $this->query_Get_Menu_by_parent_id_and_username($value_parrent_menu->menu_id,$username);
                if(!empty($value_parrent_menu->menu_link) && count($child_menu) == 0){
                    $menu_icon = (isset($value_parrent_menu->menu_icon)  && !empty($value_parrent_menu->menu_icon)) ? $value_parrent_menu->menu_icon : asset("img/logo_rpx.png");
                    $menu_icon_white = (isset($value_parrent_menu->menu_icon_white)  && !empty($value_parrent_menu->menu_icon_white)) ? $value_parrent_menu->menu_icon_white : asset("img/logo_rpx.png");
                    $html .= "
                    <li class='nav-item' id='li_".$value_parrent_menu->id_dom."'>
                        <a class='nav-link text-xs' href='".url("".$value_parrent_menu->menu_link."")."' id='a_".$value_parrent_menu->id_dom."'>
                            <div class='icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center'>
                                <img src='".$menu_icon."' width='21px' height='21px' alt='Logo' id='logo_".$value_parrent_menu->id_dom."' class=''>
                                <img src='".$menu_icon_white."' width='21px' height='21px' alt='Logo' id='logo_white_".$value_parrent_menu->id_dom."' class='d-none'>
                            </div>
                            <span class='nav-link-text ms-1'>".$value_parrent_menu->description."</span>
                        </a>
                    </li>";
                }else if (empty($value_parrent_menu->menu_link) && count($child_menu) > 0) {
                    $menu_icon = (isset($value_parrent_menu->menu_icon)  && !empty($value_parrent_menu->menu_icon)) ? $value_parrent_menu->menu_icon : asset("img/logo_rpx.png");
                    $menu_icon_white = (isset($value_parrent_menu->menu_icon_white)  && !empty($value_parrent_menu->menu_icon_white)) ? $value_parrent_menu->menu_icon_white : asset("img/logo_rpx.png");
                    $html .= "
                    <li class='nav-item' id='li_".$value_parrent_menu->id_dom."'>
                        <a data-bs-toggle='collapse' href='#dropdown_".$value_parrent_menu->id_dom."' class='nav-link text-xs' id='dropdown_toggle_".$value_parrent_menu->id_dom."' aria-controls='dropdown_".$value_parrent_menu->id_dom."' role='button' aria-expanded='false'>
                            <div class='icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center '>
                                <img src='".$menu_icon."' width='21px' height='21px' alt='Logo' id='logo_".$value_parrent_menu->id_dom."' class=''>
                                <img src='".$menu_icon_white."' width='21px' height='21px' alt='Logo' id='logo_white_".$value_parrent_menu->id_dom."' class='d-none'>
                            </div>
                            <span class='nav-link-text ms-1'>".$value_parrent_menu->description."</span>
                        </a>
                        <div class='collapse' id='dropdown_".$value_parrent_menu->id_dom."'>
                            <ul class='nav ms-4 ps-3'>
                    ";
                    foreach ($child_menu as $key_child_menu => $value_child_menu) {
                        $html .= "
                            <li class='nav-item' id='li_".$value_child_menu->id_dom."'>
                                <a class='nav-link text-xs' href='".url("".$value_child_menu->menu_link."")."' id='a_".$value_child_menu->id_dom."'>
                                    <span class='sidenav-mini-icon'>".$this->getOneCharacterInString($value_child_menu->description)."</span>
                                    <span class='sidenav-normal'>".$value_child_menu->description."</span>
                                </a>
                            </li>
                        ";
                    }

                    $html .= "
                            </ul>
                        </div>
                    </li>";
                }

            }
        }
        return $html;
    }

    private function getOneCharacterInString($target_string)
    {
        return substr($target_string, 0, 1);
    }

    private function query_Get_Menu_by_parent_id_and_username($parent_id,$username)
    {
        $query = DB::query()
        ->select([
            "m_menu.menu_id",
            "m_menu.description",
            "m_menu.menu_link",
            "m_menu.menu_icon",
            "m_menu.menu_icon_white",
            "m_menu.id_dom",
        ])
        ->from("m_user_menu_access")
        ->leftJoin("m_menu","m_menu.menu_id","=","m_user_menu_access.menu_id")
        ->where("m_user_menu_access.username",$username)
        ->where("m_menu.parent_id",$parent_id)
        ->where("m_menu.is_active","Y")
        ->where("m_menu.platform_id",2)
        ->orderBy('m_menu.no_urut','ASC')
        ->get()
        ;

        if(count($query) == 0){
            return [];
        }

        return $query;
    }

    private function get_User_Access($username)
    {
        $query = DB::query()
        ->select([
            "m_user_menu_access.menu_id",
        ])
        ->from("m_user_menu_access")
        ->where("m_user_menu_access.username",$username)
        ->get()
        ;

        $data = [];
        if(count($query) == 0){
            return $data;
        }

        foreach ($query as $key_query => $value_query) {
            $data[] = $value_query->menu_id;
        }

        return $data;
    }

    private function displayError()
    {
        echo "<script>
            alert('Current User data is not complete, Please Contanct Administator.');
            window.location.href = '".route('getLogout')."'
            </script>";
        exit();
    }

    private function get_Client_Project($username)
    {
        $query_Client_Project = DB::query()
        ->select([
            "m_wh_client_project.client_project_id",
            "m_wh_client_project.client_project_name",
            "m_wh_client_project.wh_id",
            "m_warehouse.wh_name",
            "m_wh_client.client_id",
            "m_wh_client.client_name",
            "t_wh_user.username",
        ])
        ->from("t_wh_user")
        ->leftJoin("m_wh_user_client_project","m_wh_user_client_project.username","=","t_wh_user.username")
        ->leftJoin("m_wh_client_project","m_wh_client_project.client_project_id","=","m_wh_user_client_project.client_project_id")
        ->leftJoin("m_wh_client","m_wh_client.client_id","=","m_wh_client_project.client_id")
        ->leftJoin("m_warehouse","m_warehouse.wh_id","=","m_wh_client_project.wh_id")
        ->whereRaw("m_wh_user_client_project.username IS NOT NULL")
        ->where("t_wh_user.username",$username)
        ->get()
        ;

        if(count($query_Client_Project) == 0){
            return [];
        }

        return $query_Client_Project;
    }
}
