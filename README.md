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

# License

The MIT License (MIT)

Copyright (c) 2016 Zsolt Gál

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
