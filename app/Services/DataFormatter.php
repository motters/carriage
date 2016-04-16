<?php namespace App\Services;

class DataFormatter
{

    /**
     * Selects the relevant method depending on the type
     *
     * @param $type The type of sensor the data is related to
     * @param $data Data sent by the uC
     * @return string
     */
    public function format($type, $data, $previousData = false)
    {
        switch($type)
        {
            case 2:
                return $this->temperature($data, $previousData);
                break;
            case 3:
                return $this->vibration($data, $previousData);
                break;
            case 4:
                return $this->airFlow($data, $previousData);
                break;
            case 5:
                return $this->gps($data, $previousData);
                break;
            default:
                return json_encode([]);
                break;
        }
    }



    /**
     * Formats data from uC to format for the DB for the temperature sensor
     *
     * @param $data Data sent by the uC
     * @param $previousData Previous data in the DB to merged with new data
     * @return string
     */
    public function temperature($data, $previousData)
    {
        // Example data 1460769030@21.00:28.00
        $readings = [];
        $time_data = explode('@', $data);
        if($time_data[1] and $time_data[0] > 1459989919){
            $readArray = explode(':', $time_data[1]);
            if($readArray[0] < 100 and $readArray[1] < 200){
                $read['temp'] = $readArray[0];
                $read['humid'] = $readArray[1];
                $readings[$time_data[0]] = $read;
            }
        }


        // Merge previous data if there is any
        if($previousData){
            $readings_prev = json_decode($previousData, true);
            $readings += $readings_prev;
        }

        // Return json encoded data
        return json_encode($readings);
    }



    /**
     * Formats data from uC to format for the DB for the air flow sensor
     *
     * @param $data Data sent by the uC
     * @param $previousData Previous data in the DB to merged with new data
     * @return string
     */
    public function airFlow($data, $previousData)
    {
        // Example data 1460769030@2785
        $readings = [];
        $time_data = explode('@', $data);
        if($time_data[1] and $time_data[0] > 1459989919){
            $read['flow'] = $time_data[1];
        }


        // Merge previous data if there is any
        if($previousData){
            $readings_prev = json_decode($previousData, true);
            $readings += $readings_prev;
        }

        // Return json encoded data
        return json_encode($readings);
    }



    /**
     * Formats data from uC to format for the DB for the vibration sensor
     *
     * @param $data Data sent by the uC
     * @param $previousData Previous data in the DB to merged with new data
     * @return string
     */
    public function vibration($data, $previousData)
    {
        // Example data 1460769030@-4316:-2676:15908
        $readings = [];
        $time_data = explode('@', $data);
        if($time_data[1] and $time_data[0] > 1459989919){
            $readArray = explode(':', $time_data[1]);
            if($readArray[0] < 100 and $readArray[1] < 200){
                $read['x'] = $readArray[0];
                $read['y'] = $readArray[1];
                $read['z'] = $readArray[1];
                $readings[$time_data[0]] = $read;
            }
        }


        // Merge previous data if there is any
        if($previousData){
            $readings_prev = json_decode($previousData, true);
            $readings += $readings_prev;
        }

        // Return json encoded data
        return json_encode($readings);
    }



    /**
     * Formats data from uC to format for the DB for the GPS
     *
     * @param $data Data sent by the uC
     * @param $previousData Previous data in the DB to merged with new data
     * @return string
     */
    public function gps($data, $previousData)
    {
        // Example data 1460769030@3:52.265458:2.165898
        $readings = [];
        $time_data = explode('@', $data);
        if($time_data[1] and $time_data[0] > 1459989919){
            $readArray = explode(':', $time_data[1]);
            if($readArray[0] < 100 and $readArray[1] < 200){
                $read['lat'] = $readArray[1];
                $read['lng'] = $readArray[2];
                $group['address'] = $read;
                $group['title'] = "Sat No:".$readArray[0]." Time: ".$time_data[0];
                $readings[] = $group;
            }
        }


        // Merge previous data if there is any
        if($previousData){
            $readings_prev = json_decode($previousData, true);
            $readings += $readings_prev;
        }

        // Return json encoded data
        return json_encode($readings);
    }
}