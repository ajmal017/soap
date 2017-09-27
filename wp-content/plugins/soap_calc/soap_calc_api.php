<?php

class SoapCalcApi {
    
    private $table = 'soaps';

    function __construct() {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->wpdb->show_errors();
    }

    public function updateSoap($data) {
        try {
            $sql = $this->wpdb->prepare("Update `" . $this->table . "` set `indicator_analysis`=%d, `track_changes_trade_volumn`=%d, `large_order_analysis`=%d, `track_changes_large_wallet`=%d, `backtesting_historical_data`=%d, `advanced_arbitage`=%d, `social_signals`=%d where id=%d", $data['indicator_analysis'], $data['track_changes_trade_volumn'], $data['large_order_analysis'], $data['track_changes_large_wallet'], $data['backtesting_historical_data'], $data['advanced_arbitage'], $data['social_signals'], $data['id']);

            $update = $this->wpdb->query($sql);

            if ($update == true) {
                echo "Records are updated for " . $data['id'];
            } else {
                "Something went wrong";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function storeSoap() {
        try {
            $messages = array();
            $getSoapData = $_POST['soap_data'];
            if ($getCryptoData) {
                foreach ($getSoapData as $data) {
                    $id = $data->id;
                    $name = $data->name;
                    $symbol = $data->symbol;
                    $datetime = date("Y-m-d H:i:s");
                    $market_cap_usd = $data->market_cap_usd;
                    $price_usd = $data->price_usd;

                    $volume_24_usd = '24h_volume_usd';
                    $volume_24_usd = $data->$volume_24_usd;

                    $percent_change_24h = $data->percent_change_24h;
                    $status = ($data->percent_change_24h > 0) ? '1' : '2';
                    $check_coin = $this->wpdb->prepare("Select count(*) from `" . $this->table . "` where coin_name=%s", $name);
                    $count = $this->wpdb->get_var($check_coin);

                    if (!($count > 0)) {
                        $sql = $this->wpdb->prepare("INSERT INTO `" . $this->table . "` (`coin_id`, `coin_name`, `coin_symbol`, `market_cap_usd`, `price_usd`, `volume_24_usd`, `percent_change_24h`, `status`, `date_added`, `date_modified`) values (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", $id, $name, $symbol, $market_cap_usd, $price_usd, $volume_24_usd, $percent_change_24h, $status, $datetime, $datetime);
                        if ($this->wpdb->query($sql)) {
                            $coin_id = $this->wpdb->insert_id;
                            echo $messages[] = "<b>" . $name . "</b> with id " . $this->wpdb->insert_id . " is inserted.<br />";

                            $stats_sql = $this->wpdb->prepare("INSERT INTO `" . $this->stats_table . "` (`coin_id`, `price_usd`, `date_added`) values (%s, %s, %s)", $coin_id, $price_usd, $datetime);
                            if ($stats_query = $this->wpdb->query($stats_sql)) {
                                echo $messages[] = "Records are inserted in stats table for  <b>" . $name . "</b><br />";
                            } else {
                                echo $messages[] = "There is something wrong while inserting records for <b>" . $name . "</b> in stats table<br />";
                            }

                            $url = "https://files.coinmarketcap.com/static/img/coins/32x32/" . $id . ".png";


                            $saveto = $plugin_root_path . '/assets/icons/' . $id . ".png";
                            if ($saveto = $this->grab_image($url, $saveto)) {
                                echo $messages[] = "Image for <b>" . $name . "</b> is also uploaded.<br />";
                            }
                        } else {
                            echo $messages[] = "Something went wrong.<br />";
                        }
                    } else {
                        echo $messages[] = "<b>" . $name . "</b> already exists.<br />";
                        $query = $this->wpdb->prepare("Select * from " . $this->table . " where coin_id=%s and coin_name=%s" . " order by id desc", $id, $name);
                        $results = $this->wpdb->get_results($query);
                        $sql = $this->wpdb->prepare("Update `" . $this->table . "` set `market_cap_usd`=%s, `price_usd`=%s, `percent_change_24h`=%s, `status`=%s, `volume_24_usd`=%s, `date_modified`=%s where id=%d", $market_cap_usd, $price_usd, $percent_change_24h, $status, $volume_24_usd, $datetime, $results[0]->id);
                        $update = $this->wpdb->query($sql);

                        if ($update == true) {
                            echo $messages[] = "Records are updated for <b>" . $results[0]->coin_name . "</b><br />";
                            //if(date("H:i:s") == '12:00' || date("H:i") == '24:00')
                            //{
                            if ($results[0]->price_usd != $price_usd) {
                                $stats_sql = $this->wpdb->prepare("INSERT INTO `" . $this->stats_table . "` (`coin_id`, `price_usd`, `date_added`) values (%s, %s, %s)", $results[0]->id, $price_usd, $datetime);
                                if ($stats_query = $this->wpdb->query($stats_sql)) {
                                    echo $messages[] = "Records are updated in stats table for <b>" . $results[0]->coin_name . "</b><br />";
                                } else {
                                    echo $messages[] = "There is something wrong while inserting record in stats table for <b>" . $results[0]->coin_name . "</b><br />";
                                }
                            } else {
                                echo $messages[] = "Still Price in USD is same for <b>" . $results[0]->coin_name . "</b><br />";
                            }
                            //}

                            $saveto = $plugin_root_path . '/assets/icons/' . $id . ".png";
                            if (!file_exists($saveto)) {
                                $url = "https://files.coinmarketcap.com/static/img/coins/32x32/" . $id . ".png";
                                if ($saveto = $this->grab_image($url, $saveto)) {
                                    echo $messages[] = "Image for <b>" . $name . "</b> is updated.<br />";
                                }
                            }
                        } else {
                            echo $messages[] = "Recrods are not updated.<br />";
                        }
                    }
                }
            }
        } catch (Exception $e) {
            echo $messages[] = $e->getMessage();
        }
        return $messages;
    }

    public function getSoapData($site, $s = "") {
        try {
            if ($site == 'front') {
                
            } else {
      
            }

            if ($s != "") {
                $search = " WHERE `name` LIKE '%s'";
                $arr = array('%' . $this->wpdb->esc_like($s) . '%');
            } else {
                $search = "";
                $arr = array();
            }

            $query = $this->wpdb->prepare("Select s.* from " . $this->table . " as s ".$search." order by s.id asc", $arr);

            $results = $this->wpdb->get_results($query);

            if (!empty($results)) {
                return $results;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}

?>