<div id='mainContainer' class='container'>
    
    <div id="search" class='container'>
        <form class="form-inline">
            <input type="hidden" id='token' name='token' value='<?php echo $access_token; ?>'>
            <input type="text" id='page' class="input span4" placeholder="facebook page e.g.: nzz, blick...">
            <select id='days' class='input-small'>
                <option value="2">2 days</option>
                <option value="10">10 days</option>
                <option value='20'>20 days</option>
                <option value='30'>30 days</option>
            </select>
            <button id='getAnalysis' class="btn btn-info">Get analysis!</button>
            <button id='getLink' class="btn btn-info">Get link!</button>
        </form>
    </div>

    <div class="link"></div>
    
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