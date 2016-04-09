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
            default:
                return json_encode([]);
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
        \Log::info($data);
        // Example data SUBHUB-API-KEY}SH-D-3!2!,1459983417@23.00:26.00,1459983421@23.00:25.00}SH-I2C-105!3!,1459983421@664:-3980:16112,1459983423@632:-3952:16288}SH-I2C-105!3!,1459983425@580:-3964:16276,1459983427@592:-3996:16084}SH-D-3!2!,1459983425@23.00:26.00,1459983429@23.00:25.00}SH-I2C-SH-I2C-105!3!,1459983546@624:-4068:16096,1498582:43110SD321595620:601985@302.}H2-531595@4-0:621985@4351204}SH-I2C-105!3!,1459983554@612:-3972:16108,1459983556@544:-3976:16200}SH-D-3!2!,1459983554@23.00:25.00,1459983558@23.00:26.00}SH-I2C-105!3!,1459983558@492:-4020:16176,1459983560@548:-4016:16096}SH-I2C-105!3!,1459983562@520:-4060:16188,1459983564@612:-4052:16052}SH-D-3!2!,1459983562@23.00:26.00,1459983566@23.00:26.00}SH-I2C-105!3!,1459983566@568:-3952:16108,1459983568@568:-4008:16176}SH-I2C-105!3!,1459983570@580:-3932:16080,1459983572@584:-3868:16248}SH-D-3!2!,1459983570@23.00:26.00,1459983574@23.00:26.00}SH-I2C-105!3!,1459983574@508:-4004:16108,1459983576@528:-3928:15992}

        $data = explode(',', $data);

        // Format data
        $readings = [];
        foreach($data as $no => $value)
        {
            $time_data = explode('@', $value);
            if($time_data[1] and $time_data[0] > 1459989919){
                $readArray = explode(':', $time_data[1]);
                if($readArray[0] < 100 and $readArray[1] < 200){
                    $read['temp'] = $readArray[0];
                    $read['humid'] = $readArray[1];
                    $readings[$time_data[0]] = $read;
                }
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