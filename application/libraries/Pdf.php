<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter PDF Library
 *
 * Generate PDF's in your CodeIgniter applications.
 *
 * @package			CodeIgniter
 * @subpackage		Libraries
 * @category		Libraries
 * @author			The Pocket
 * @license			PK License
 */

require_once  APPPATH."libraries/dompdf/autoload.inc.php";

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf
{
    private $html = '';

    protected $zone = '';
    protected $folder = '';
    protected $data_head = [];
    protected $data_header = [];
    protected $filename = '';
    protected $init_folder = 'docs';
    protected $defaultZone = 'print';

    public $Options = '';

    public function __construct($options = null)
    {
        parent::__construct($options);
        $this->Options = new Options();
    }

    /**
     * Get an instance of CodeIgniter
     *
     * @access	protected
     * @return	CI_Controller
     */
    protected function ci()
    {
        return get_instance();
    }

    public function zone($zone = '')
    {
        $this->zone = $zone;
        return $this;
    }

    public function folder($folder = '')
    {
        $this->folder = $folder;
        return $this;
    }

    public function ini_folder($init_folder = 'docs')
    {
        $this->init_folder = $init_folder;
        return $this;
    }

    public function filename($filename = 'file.pdf')
    {
       $this->filename = $filename;
       return $this;
    }

    public function getHTML($echo = true){
        if($echo == true)
            echo $this->html;
        else
            return $this->html;
    }

    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access	public
     * @param	string	$view The view to load
     * @param	array	$data The view data
     * @return	Pdf
     */
    public function load_view($view, $data = array())
    {
        $this->html = $this->ci()->load->view($this->zone.'/'.$view.'-print', $data, TRUE);
        $this->loadHtml($this->html);
        return $this;
    }

    /**
     * Render a CodeIgniter view into domPDF
     *
     * @access	public
     * @param	string	$view The view to load
     * @param	array	$data The view data
     * @param	bool	$header The view header to load
     * @return	Pdf
     */
    public function render_view($view, $data = array(), $header = true)
    {
        $this->data_head['titre'] = [(($this->filename)?str_ireplace(['-', '.pdf'], [' ', ''], trim($this->filename)):''), ' - '];
        $this->html = $this->ci()->load->view($this->defaultZone.'/head', $this->data_head, TRUE);
        if($header === true)
            $this->html .= $this->ci()->load->view($this->defaultZone.'/header', $this->data_header, TRUE);
        $this->html .= $this->ci()->load->view($this->zone.'/'.$view.'-print', $data, TRUE);
        $this->html .= $this->ci()->load->view($this->defaultZone.'/foot', $data, TRUE);
        $this->loadHtml($this->html);
        return $this;
    }

    /**
     * @param string $filename
     * @return bool
     */
    public function generate($stream = true){
        try {
            $this->setOptions($this->Options);
            if ($stream === false) {
                $this->folder = $this->init_folder . '/' . $this->folder;
                $this->folder = (is_dir($this->folder) ? $this->folder : asset_path($this->folder));
                $this->filename = rtrim(rtrim($this->folder, '/\\') . '/' . $this->filename, '/\\');

                $extension = @pathinfo($this->filename, PATHINFO_EXTENSION);
                if (!$extension) {
                    $this->filename = rtrim($this->filename, '.') . '.pdf';
                } elseif (strcmp($extension, 'pdf') == 0) {
                    $this->filename = preg_replace('/.' . $extension . '$/', '.pdf', $this->filename);
                }

                $directory = @pathinfo($this->filename, PATHINFO_DIRNAME);

                if (strcmp($directory, '.') == 0) {
                    $this->filename = asset_path($this->init_folder . '/' . ltrim($this->filename, '/\\'));
                } elseif (!is_dir($directory) And mkdir($directory, 0755, true) === false) {
                    page_error('Erreur lors de la création des repertoires "' . $directory . '"');
                    return false;
                }

                $this->render();
                if (file_put_contents($this->filename, $this->output()) === false) {
                    page_error('Impossible de générer le fichier ' . pathinfo($this->filename, PATHINFO_BASENAME) . '.');
                    return false;
                }
                return true;
            } else {
                $this->render();
                $this->stream($this->filename, array("Attachment" => 0));
                return true;
            }
        } catch (DOMPDF_Exception $ex) {
            page_error($ex->getMessage());
            return false;
        }
    }
}