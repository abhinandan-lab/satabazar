<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <link rel="stylesheet" href="<?= base_url();?>/public/asset/css/satta.css">
</head>
<body>

    <div class="container">
        <h1 class="logo">sata bazar</h1>

        <div class="sattalist">
            <h2>LIVE RESULT</h2>


            <div class="action">
                <a href="<?= base_url();?>/create">Create satta</a>
            </div>
            <div class="item admin">
                <button type="button">Jodi</button>
                <div class="info">
                    <h3><input type="text" value="Madhuri satta"></h3>
                    <div class="number">
                        <div>
                            <input type="text" maxlength="3" value="143">
                            <p>-</p>
                            <input class="ch1" type="text" maxlength="1" value="4">
                        </div>
                        <div>
                            <input class="ch1" type="text" maxlength="1" value="4">
                            <p>-</p>
                            <input type="text" maxlength="3" value="143">
                        </div>
                    </div>

                    <div class="time">


                        <div class="start">
                            <input type="time" name="start-time" id="start-time">
                            <label for="start-time">11:15 pm</label>
                        </div>

                        <div class="endt">
                            <input type="time" name="end-time" id="end-time">
                            <label for="end-time">12:12 am</label>
                        </div>
                    </div>

                    <div class="controls">

                        <button>Delete</button>
                        <button>Save</button>
                    </div>
                </div>
                <button type="button">Panel</button>
            </div>

            <div class="item admin">
                <button type="button">Jodi</button>
                <div class="info">
                    <h3><input type="text" value="Madhuri satta"></h3>
                    <div class="number">
                        <div>
                            <input type="text" maxlength="3" value="143">
                            <p>-</p>
                            <input class="ch1" type="text" maxlength="1" value="4">
                        </div>
                        <div>
                            <input class="ch1" type="text" maxlength="1" value="4">
                            <p>-</p>
                            <input type="text" maxlength="3" value="143">
                        </div>
                    </div>

                    <div class="time">


                        <div class="start">
                            <input type="time" name="start-time" id="start-time">
                            <label for="start-time">11:15 pm</label>
                        </div>

                        <div class="endt">
                            <input type="time" name="end-time" id="end-time">
                            <label for="end-time">12:12 am</label>
                        </div>
                    </div>

                    <div class="controls">

                        <button>Delete</button>
                        <button>Save</button>
                    </div>
                </div>
                <button type="button">Panel</button>
            </div>

            <div class="item admin">
                <button type="button">Jodi</button>
                <div class="info">
                    <h3><input type="text" value="Madhuri satta"></h3>
                    <div class="number">
                        <div>
                            <input type="text" maxlength="3" value="143">
                            <p>-</p>
                            <input class="ch1" type="text" maxlength="1" value="4">
                        </div>
                        <div>
                            <input class="ch1" type="text" maxlength="1" value="4">
                            <p>-</p>
                            <input type="text" maxlength="3" value="143">
                        </div>
                    </div>

                    <div class="time">


                        <div class="start">
                            <input type="time" name="start-time" id="start-time">
                            <label for="start-time">11:15 pm</label>
                        </div>

                        <div class="endt">
                            <input type="time" name="end-time" id="end-time">
                            <label for="end-time">12:12 am</label>
                        </div>
                    </div>

                    <div class="controls">

                        <button>Delete</button>
                        <button>Save</button>
                    </div>
                </div>
                <button type="button">Panel</button>
            </div>


        </div>



        <script>
            var times = {}, re = /^\d+(?=:)/;

            for (var i = 13, n = 1; i < 24; i++, n++) {
                times[i] = n < 10 ? "0" + n : n
            }

            document.getElementById("end-time")
                .onchange = function () {
                    var time = this
                        , value = time.value
                        , match = value.match(re)[0];
                    this.nextElementSibling.innerHTML =
                        (match && match >= 13 ? value.replace(re, times[match]) : value)
                        + (time.valueAsDate.getTime() < 43200000 ? " AM" : " PM")
                }


            document.getElementById("start-time")
                .onchange = function () {
                    var time = this
                        , value = time.value
                        , match = value.match(re)[0];
                    this.nextElementSibling.innerHTML =
                        (match && match >= 13 ? value.replace(re, times[match]) : value)
                        + (time.valueAsDate.getTime() < 43200000 ? " AM" : " PM")
                }
        </script>




</body>
</html>