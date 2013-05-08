<div id='mainContainer' class='container'>
	<!-- <div class='hero-unit'><h1><?php //echo COMPANY_NAME; ?></h1></div>	 -->
    

    <div id="search" class='container'>
        <form class="form-inline">
            <input type="hidden" id='token' name='token' value='<?php echo $access_token; ?>'>
            <input type="text" id='page' class="input span9" placeholder="facebook page e.g.: nzz, blick...">
            <button id='getAnalysis' class="btn btn-large btn-info pull-right">Get analysis!</button>
        </form>
    </div>
    
    <div id='loading' class='hide'><h3>Loading...</h3></div>

        <div id="analysis">
        

        </div>
</div>