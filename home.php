<div id='mainContainer' class='container'>
	<!-- <div class='hero-unit'><h1><?php //echo COMPANY_NAME; ?></h1></div>	 -->
    

    <div id="search" class='container'>
        <div class="row">
            <form class="form-inline">
                <input type="hidden" id='token' name='token' value='<?php echo $access_token; ?>'>
                <input type="text" id='page' class="input span9" placeholder="facebook page e.g.: nzz, blick...">
                <button id='getAnalysis' class="btn span3 btn-info pull-right">Get analysis!</button>
            </form>
        </div>
    </div>
    
    <div id='loading' class='hide'>
        <div class="overlay">
            <h3 class='loadingText'>Loading...</h3>
            <div class="progress progress-striped active">
                <div class="bar" style="width: 0%;"></div>
            </div>
        </div>
    </div>

        <div id="analysis">
        

        </div>
</div>