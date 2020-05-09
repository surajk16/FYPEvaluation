<!DOCTYPE html>
<html>
  <head>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript" src="{{asset('/data/data.json')}}"></script> 
    <script src="{{asset('/js/main.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/css/main.css')}}">

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
        <div class="col s12 m6 l6">
            <div id="example">
                <h4>Example</h4>
            </div>
        </div>
        <div class="col s12 m6 l6">
            <h4>Fill in your views</h4>
            <br>
            <form id="regForm" action="#">
                <div class="tab">
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
                </div>
                <div class="tab">
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
                </div>
                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button class="btn waves-effect waves-light" type="button" id="prevBtn">Previous</button>
                        <button class="btn waves-effect waves-light" type="button" id="nextBtn">Next</button>
                    </div>
                </div>

                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
            </form>
        </div>
    </div>
  </body>
</html>