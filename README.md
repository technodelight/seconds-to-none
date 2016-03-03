# seconds-to-none
Seconds to human / human to seconds

This is a very minimal library to allow conversion between human time duration representation and time in seconds.
Usage:

```
$converter = new \Technodelight\SecondsToNone;
$textRepresentation = $converter->secondsToHuman(12345);
// => '3 hours 25 minutes 45 seconds'
$seconds = $converter->humanToSeconds('3 hours 25 minutes 45 seconds');
// => 12345
```

If you want, you can configure how the representations are looking like.
```
$config = new Technodelight\SecondsToNone\Config(['h' => 3600, 'm' => 60, 's' => 1, 'none' => 0]);
// above secondsToHuman output with the following config:
// 3 h 25 m 45 s
```

This micro-library also comes with tests!

