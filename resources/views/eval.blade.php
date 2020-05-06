<!DOCTYPE html>
<html>
  <head>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript" src="{{asset('/data/data.json')}}"></script> 
    <script src="{{asset('/js/main.js')}}"></script>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


    <meta charset="UTF-8">
    <title>FYP Evaluation</title>
  </head>

  <body>

    <h1 style="text-align: center"> Evaluation of Anchors </h1>

    <div class=row>
        <div class="col s6">
            <div id="example">
                <h4>Example</h4>
            </div>
        </div>
        <div class="col s6">
            <h4>Fill in your views</h4>
            <br>
            <form action="#">
                <h6>What do you think will be the annual income of the following person?</h6>
                <p>
                    <label>
                        <input class="with-gap" name="without-anchor" type="radio" value=0 />
                        <span>Less than $50K</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input class="with-gap" name="without-anchor" id="without-anchor" type="radio" value=1 />
                        <span>More than $50K</span>
                    </label>
                </p>

                <br>

                <div id="anchors">
                    <h6>Anchors</h6>
                </div>

                <br>

                <h6>What do you think will be the annual income of the following person after looking at the following anchors?</h6>
                <p>
                    <label>
                        <input class="with-gap" name="with-anchor" type="radio" value=0 />
                        <span>Less than $50K</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input class="with-gap" name="with-anchor" type="radio" value=1 />
                        <span>More than $50K</span>
                    </label>
                </p>
            </form>
            <br>
            <button class="btn waves-effect waves-light disabled" id="submit">Submit</button>
    </div>
  
  </body>
</html>