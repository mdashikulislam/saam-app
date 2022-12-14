<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// -----------------------------------------------------------------------------
// Get Language by ID
function get_lang_name_by_id($id)
{
    $ci = & get_instance();
    $ci->db->where('id',$id);
    return $ci->db->get('ci_language')->row_array()['name'];
}

// -----------------------------------------------------------------------------
// Get Language Short Code
function get_lang_short_code($id)
{
    $ci = & get_instance();
    $ci->db->where('id',$id);
    return $ci->db->get('ci_language')->row_array()['short_name'];
}

// -----------------------------------------------------------------------------
// Get Language List
function get_language_list()
{
    $ci = & get_instance();
    $ci->db->where('status',1);
    return $ci->db->get('ci_language')->result_array();
}

// -----------------------------------------------------------------------------
// Get Admin name by ID
function get_admin_name($id)
{
    $ci = & get_instance();
    $ci->db->where('user_id',$id);
    $ret = $ci->db->get('ci_users')->row_array()['username'];
    if($ret === null || trim($ret) === '') //DH in case of the 'creator' has been deleted
        return 'Unknown';
    return $ret;
}

// -----------------------------------------------------------------------------
// Get country list
function get_country_list()
{
    $ci = & get_instance();
    return $ci->db->get('ci_countries')->result_array();
}

// -----------------------------------------------------------------------------
// Get country name by ID
function get_country_name($id)
{
    $ci = & get_instance();
    return $ci->db->get_where('ci_countries', array('id' => $id))->row_array()['name'];
}

// -----------------------------------------------------------------------------
// Get City ID by Name
function get_country_id($title)
{
    $ci = & get_instance();
    return $ci->db->get_where('ci_countries', array('slug' => $title))->row_array()['id'];
}

// -----------------------------------------------------------------------------
// Get country slug
function get_country_slug($id)
{
    $ci = & get_instance();
    return $ci->db->get_where('ci_countries', array('id' => $id))->row_array()['slug'];
}

// -----------------------------------------------------------------------------
// Get country's states
function get_country_states($country_id)
{
    $ci = & get_instance();
    return $ci->db->select('*')->where('country_id',$country_id)->get('ci_states')->result_array();
}

// -----------------------------------------------------------------------------
// Get state's cities
function get_state_cities($state_id)
{
    $ci = & get_instance();
    return $ci->db->select('*')->where('state_id',$state_id)->get('ci_cities')->result_array();
}

// Get state name by ID
function get_state_name($id)
{
    $ci = & get_instance();
    return $ci->db->get_where('ci_states', array('id' => $id))->row_array()['name'];
}

// -----------------------------------------------------------------------------
// Get city name by ID
function get_city_name($id)
{
    $ci = & get_instance();
    return $ci->db->get_where('ci_cities', array('id' => $id))->row_array()['name'];
}

// -----------------------------------------------------------------------------
// Get city ID by title
function get_city_slug($id)
{
    $ci = & get_instance();
    return $ci->db->get_where('ci_cities', array('id' => $id))->row_array()['slug'];
}

/**
 * Generic function which returns the translation of input label in currently loaded language of user
 * @param $string
 * @return mixed
 */
function trans($string) //DH modif
{
    $ci =& get_instance();
    // return $ci->lang->line($string); //DH : original line

    $tmp = $ci->lang->line($string);
    if( !empty($tmp) )
    	return $tmp;
    return '!'. $string . '!';
}

if (!function_exists('pp')){
	function pp($data){
		echo '<pre style="padding:10px;">';
		print_r($data);
		echo '</pre>';
		exit();
	}
}

if (!function_exists('getVenueDropdown')){
	function getVenueDropdown($venue_id = 0)
	{
		$ci = &get_instance();
		$query = $ci->db->get_where('ci_venues');
		$options = '<option value="">Select Venue</option>';
		foreach ($query->result() as $row) {
			$options .= '<option value="' . $row->id . '" ';
			$options .= ($row->id == $venue_id) ? 'selected="selected"' : '';
			$options .= '>' . $row->name . '</option>';
		}
		return $options;
	}
}
if (!function_exists('getPersonDropdown')){
	function getPersonDropdown($selected = '')
	{
		$query = [
			0=>'Staff',
			1=>'Customer'
		];
		$options = '<option value="">Select Person</option>';
		foreach ($query as $key => $row) {
			$options .= '<option value="' . $key . '" ';
			$options .= ($key == $selected && $selected !='') ? ' selected="selected" ' : '';
			$options .= '>' . $row . '</option>';
		}
		return $options;
	}
}

if (!function_exists('getGenderDropdown')){
	function getGenderDropdown($selected = '')
	{
		$query = [
			0=>'Female',
			1=>'Male',
			2=>'Other'
		];
		$options = '<option value="">Select Gender</option>';
		foreach ($query as $key => $row) {
			$options .= '<option value="' . $key . '" ';
			$options .= ($key == $selected && $selected !='') ? ' selected="selected" ' : '';
			$options .= '>' . $row . '</option>';
		}
		return $options;
	}
}
function getGender($key){
	$query = [
		0=>'Female',
		1=>'Male',
		2=>'Other'
	];
	return $query[$key];
}
function getPerson($key){
	$query = [
		0=>'Staff',
		1=>'Customer'
	];
	return $query[$key];
}
