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
        }
    }


    /**
     * Formats data from uC to format for the DB
     *
     * @param $data Data sent by the uC
     * @return string
     */
    public function temperature($data, $previousData)
    {
        // Example data sub_v1_1}SH-D-3!2!1459533399@24.2:12.5,1459533542@25.2:13.5,1459533642@27.2:13.5,1459533742@15.2:24.5}
        $data = explode(',', $data);

        // Format data
        $readings = [];
        foreach($data as $no => $value)
        {
            $time_data = explode('@', $value); $readArray = explode(':', $time_data[1]);
            $read['temp'] = $readArray[0];
            $read['humid'] = $readArray[1];
            $readings[$time_data[0]] = $read;
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