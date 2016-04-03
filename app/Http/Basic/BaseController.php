<?php namespace App\Http\Controllers\Basic;

use Illuminate\Support\Facades\Log;

class BaseController extends \App\Http\Controllers\Controller
{

    protected $side_menu           = NULL;
    protected $current_user        = NULL;

    protected $current_gal         = NULL;
    
    public function __construct()
    {
        $this->current_user = \Auth::user();
        $this->side_menu    = \App\Repositories\Ui\Navigation\Sidemenu::make();
    }

    protected function getBreadcrumbs()
    {
    	return [];
    }

    protected function getMessages()
    {
    	return [];
    }

    protected function getNotifications()
    {
        return [];
    }

    protected function makeNavigation( $extra = NULL )
    {
        new \App\Repositories\Galonline\Navigation\Main($this->side_menu, $this->current_user);
    }

    protected function data($title = '', $small = '')
    {
    	return [
    		'breadcrumb'    => $this->getBreadcrumbs(),
    		'messages'      => $this->getMessages(),
            'notifications' => $this->getNotifications(),
            'mainmodal'     => \App\Repositories\Ui\Modal\Modal::make()->id('main-modal')->closable(true),
            'navigation'    => $this->side_menu,
            'page' => [
                'title' => $title,
                'small' => $small,
            ],
    	];
    }

    protected function log($message, $type){
        switch($type){
            case 'info':
                Log::info($message);
            break;
            case 'warning':
                Log::warning($message);
            break;
            case 'error':
                Log::error($message);
            break;
        }
//        call_user_func(['Illuminate\Support\Facades\Log', $type]);
    }

 
}
