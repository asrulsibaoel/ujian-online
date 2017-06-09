<?php 
function indonesiaDate($date) {
 $months = [
 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
 ];
 $dates = explode('-', $date);
 return $dates[2] . ' ' . $months[intval($dates[1]) - 1] . ' ' . $dates[0];
}
?>