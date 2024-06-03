<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    protected bool $isAdmin = false;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $model = new SettingsModel();
        $this->data['siteName'] = $model->getSetting('siteName');
        $this->data['title'] = '';

        if ($this->request->uri->getSegment(1) == 'admin') {
            $this->isAdmin = true;
        }

        $this->session = \Config\Services::session();
        $this->session->start();
        $isLoggedInUser = $this->session->get('isLoggedInUser');
        $this->data['user'] = ['name' => '', 'email' => ''];

        if ($isLoggedInUser) {
            $userModel = new UserModel();
            $this->data['user'] = $userModel->getUser($this->session->get('id'));
        }

        if (
            $isLoggedInUser == null &&
            $this->request->uri->getSegment(1) != 'login' &&
            !$this->isAdmin &&
            $this->request->uri->getSegment(1) != 'api'
        ) {
            $this->session->setFlashdata('error', 'İçeriği görmek için giriş yapmalısınız.');
            return redirect()->to('login')->send();
        }

        $isloggedInAdmin = $this->session->get('isLoggedInAdmin');
        if (
            $isloggedInAdmin == null &&
            ($this->request->uri->getSegment(1) != 'admin' ||
                $this->request->uri->getSegment(2) != 'login') &&
            $this->isAdmin
        ) {
            $this->session->setFlashdata('error', 'İçeriği görmek için giriş yapmalısınız.');
            return redirect()->to('admin/login')->send();
        }

        // E.g.: $this->session = \Config\Services::session();
    }
}
