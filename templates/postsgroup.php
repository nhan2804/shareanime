<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Auto Post To Groups</title>
  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
</head>
<body>
  <div class="container">
    <h3><a href="https://m.facebook.com/composer/ocelot/async_loader/?publisher=feed" target="_blank">First click here to get the token</a></h3>
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <label for="first">Access Token</label>
            <input type="text" class="form-control" placeholder="Access Token..." id="access-token">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <label for="first">Spam target (separated by ";")</label>
            <textarea type="text" class="form-control" placeholder="Groups id..." id="spam-target"></textarea>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <label for="last">Message (separated by "|")</label>
            <textarea type="text" class="form-control" placeholder="Message..." id="spam-message"></textarea>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <label for="last">URL (*Requires upload file)</label>
            <input type="text" class="form-control" placeholder="Image URL" id="spam-attachment">
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
          <div class="form-group">
            <label for="last">Timer (millisecond)</label>
            <input type="text" class="form-control" placeholder="Distance per post..." id="spam-timer" value="10000">
          </div>
          </div>
        </div>
      </div>
      <div class="col-md-6" id="logText">
      
      </div>
    </div>
    <button id="start-spam" class="btn btn-primary">Submit</button>
    <button id="clean-spam" class="btn btn-primary">Clean</button>
    <button id="group-spam" class="btn btn-info">Get Groups ID</button>
  </div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
  <script>
    $("#start-spam").click(e => {
        var counter = 0;
        var countPost = 0;
        let messages = $('#spam-message').val().split('|');
        let targets = $('#spam-target').val().split(';');
        let timer = $('#spam-timer').val();
        targets.forEach(target => {
            counter++;
            setTimeout(() => {
                let mess = messages[~~(Math.random() * messages.length)];
                $.post("https://graph.facebook.com/" + target + "/photos", {
                    access_token: $('#access-token').val(),
                    message: mess,
                    url: $('#spam-attachment').val()
                }).then(dataPost => {
                    countPost++;
                    var link = "https://www.facebook.com/" + dataPost.post_id;
                    $('#logText').append('<span style="color: green;">Posted ' + countPost + ' on <a href="' + link + '" target="_blank">' + dataPost.post_id + '</a></span><br/>');
                    if (countPost === targets.length) {
                        timeOutDone();
                    };
                }).fail(() => {
                    countPost++;
                    var link = "https://www.facebook.com/" + target;
                    $('#logText').append('<span style="color: red;">Failed to post ' + countPost + ' on <a href="' + link + '" target="_blank">' + target + '</a></span><br/>');
                    if (countPost === targets.length) {
                        timeOutDone();
                    };
                });
            }, counter * timer);
        });
        $('#logText').append('<span style="color: black;font-weight: bold;"> - - - - START - - - -</span><br/>');
    });
    $("#clean-spam").click(e => {
        $('#logText').html("");
    });
    $("#group-spam").click(e => {
        var groupsId = '';
        $('#logText').html("");
        $.get("https://graph.facebook.com/me/groups", {
            access_token: $('#access-token').val()
        }).then(dataGet => {
            console.log(dataGet);
            dataGet.data.forEach(groupId => {
                groupsId += ';' + groupId.id;
            });
            $('#logText').html(groupsId.substring(1, groupsId.length));
        }).fail(() => {
            $('#logText').append('<span style="color: red;"> - - - - Failed - - - -</span><br/>');
        });
    });
    function timeOutDone() {
        $('#logText').append('<span style="color: blue;"> - - - - DONE - - - -</span><br/>');
    };
  </script>
</body>
