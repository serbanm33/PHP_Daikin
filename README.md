# PHP_Daikin
Based on information available publicly I have build this class for controlling Daikin AC units from PHP. This code was tested and is working with the Daikin BRP069B43 & BRP069B45 WiFi modules; however is not working with Altherma heat pomps.

I highly recommend that before and after you send a command to an AC unit, use a delay of at least 1000 microseconds (usleep(1000)). WiFi modules have very poor processing power and is very easy to flood them.

DISCLAIMER: I have no affiliation with Daikin, I have multiple AC units from them and I needed a way to control this units from my custom home automation.

# How to use
- Save the PHP_Daikin.php to a path of your liking;
- Require/require once/import the file where you want to use the class;
- Create a new instance of the PHP_Daikin class
- Set the IP address of the AC unit
- Call the appropriate function

# Get AC info
Code:
```
$Daikin = new PHP_Daikin();
$Daikin->Unit_IP = '192.168.1.100';
$Status = $Daikin->GetControlInfo();
```

Result:
```
Array
(
    [ret] => OK
    [pow] => 0
    [mode] => 3
    [adv] => 
    [stemp] => 18.0
    [shum] => 0
    [dt1] => 25.0
    [dt2] => M
    [dt3] => 18.0
    [dt4] => 25.0
    [dt5] => 25.0
    [dt7] => 25.0
    [dh1] => AUTO
    [dh2] => 50
    [dh3] => 0
    [dh4] => 0
    [dh5] => 0
    [dh7] => AUTO
    [dhh] => 50
    [b_mode] => 3
    [b_stemp] => 18.0
    [b_shum] => 0
    [alert] => 255
    [f_rate] => 5
    [f_dir] => 0
    [b_f_rate] => 5
    [b_f_dir] => 0
    [dfr1] => 5
    [dfr2] => 5
    [dfr3] => 5
    [dfr4] => 5
    [dfr5] => 5
    [dfr6] => 5
    [dfr7] => 5
    [dfrh] => 5
    [dfd1] => 0
    [dfd2] => 0
    [dfd3] => 0
    [dfd4] => 0
    [dfd5] => 0
    [dfd6] => 0
    [dfd7] => 0
    [dfdh] => 0
)
```
# Set AC unit to cold mode
The following code will start the AC unit to cold mode and set the require temperature to 23 degrees celsius. Please refer to SetControlInfo function for input parameter accepted values.

Code:
```
usleep(1000);
$Daikin->SetControlInfo(1,3,23,'AUTO','B',0);
usleep(1000);
```

# Set AC unit to hot mode
The following code will start the AC unit to hot mode and set the require temperature to 23 degrees celsius. Please refer to SetControlInfo function for input parameter accepted values.

Code:
```
usleep(1000);
$Daikin->SetControlInfo(1,4,23,'AUTO','B',0);
usleep(1000);
```

#Stop AC unit
The following code will stop the AC unit and set it to auto mode.

Code:
```
usleep(1000);
$Daikin->SetControlInfo(0);
usleep(1000);
```

# Reboot the AC unit
Code:
```
usleep(1000);
$Daikin->Reboot();
usleep(1000);
```

# Set WiFi interface LEDs on/off
Code:
```
usleep(1000);
$Daikin->SetLED(TRUE);
usleep(1000);
```
