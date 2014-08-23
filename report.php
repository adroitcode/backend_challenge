<?php
define('ga_email','adroitcode@gmail.com');
define('ga_password','');
define('ga_profile_id','89970611');

require 'gapi.class.php';

$ga = new gapi(ga_email,ga_password);
  



    

  get_user_views('2');
  get_unqiue_visitors_count();
  get_all_views();
  get_last_week_views();
  get_last_month_views();
  
function get_all_views(){
    global $ga;
    $results = $ga->requestReportData(ga_profile_id,array('source'),array('pageviews'));
    echo $results[0]->getPageviews();
    if(count($results) > 0){
      $results[0]->getPageviews();
    }else{
      return null;
    }
  }


  function get_last_week_views(){
    global $ga;
    $end_week = strtotime("last sunday midnight");
    $start_week = strtotime("-1 week",$end_week);
    $end_week_str = date("Y-m-d",$end_week);
    $start_week_str = date("Y-m-d",$start_week);
    // echo $start_week;
    // echo $end_week;
    $results = $ga->requestReportData(ga_profile_id,array('source'),array('pageviews'),null,null,$start_week_str, $end_week_str);
    var_dump($results); 
    if(count($results) > 0){
      return $results[0]->getPageviews();
    }else{
      return null;
    }
  }

  function get_last_month_views(){
    global $ga;
    //Gets the first of this month
    $end_week = strtotime(date('01-m-Y'));
    $start_week = strtotime("-1 month",$end_week);
    $end_week_str = date("Y-m-d",$end_week);
    $start_week_str = date("Y-m-d",$start_week);
    // echo $start_week;
    // echo $end_week;
    $results = $ga->requestReportData(ga_profile_id,array('source'),array('pageviews'),null,null,$start_week_str, $end_week_str);
    if(count($results) > 0){
      echo $results[0]->getPageviews();
      return $results[0]->getPageviews();
    }else{
      return null;
    }

  }


  function get_unqiue_visitors_count(){
    global $ga;
    $results = $ga->requestReportData(ga_profile_id,array('source'),array('pageviews','visitors'));
    var_dump($results);
    echo $results[0]->getVisitors();
    return $results[0]->getVisitors();
  }



  //Pass in user table id
  //Filters by dimension "User Id"
  function get_user_views($userid){
    global $ga;   
    $filter = 'ga:dimension1 == ' . $userid;
    $results = $ga->requestReportData(ga_profile_id,array('dimension1'),array('pageviews'),null,$filter);
    $viewCount = $results[0]->getPageviews();
    echo $viewCount;
    return $viewCount;
  }





?>