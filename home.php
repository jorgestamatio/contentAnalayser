<div id='mainContainer' class='container'>

    <div id="search" class='container'>
        <form class="form-inline span8">
            <input type="hidden" id='token' name='token' value='<?php echo $access_token; ?>'>
            <input type="text" id='page' class="input span4" placeholder="facebook page e.g.: nzz, blick...">
            <select id='days' class='input-small'>
                <option value="2">2 days</option>
                <option value="10">10 days</option>
                <option value='20'>20 days</option>
                <option value='30'>30 days</option>
            </select>
            <button id='getAnalysis' class="btn btn-info">Get analysis!</button>
            <a href="index.php" id='newAnalysis' class='btn btn-success hide'>New analysis!</a>
            <!-- <button id='getLink' class="btn btn-info">Get link!</button> -->
        </form>
        <button id='showCsv' class='btn btn-success hide pull-right'>Show Data</button>
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

        <div id="graphs" class='clearfix'>
            <div id="likesGraph"></div>
            <div id="typesGraph"></div>
        </div>
        <br><br>
        <div id='info' class='row hide'>
            <div class="span3"><div class='well'><h3>Posts</h3><h3 id='numberPosts'></h3></div></div>
            <div class="span3"><div class='well'><h3>Total likes</h3><h3 id='totalLikes'></h3></div></div>
            <div class="span3"><div class='well'><h3>Posts</h3><h3 id=''></h3></div></div>
            <div class="span3"><div class='well'><h3>Posts</h3><h3 id=''></h3></div></div>
        </div>


        <!-- <div id="analysis" class='hide'></div> -->
        <div id='analysisContainer' class='hide'>
            <table class='table'>
                <thead>
                    <th>Newspaper</th>
                    <th>Date</th>
                    <th>Message length</th>
                    <th>Likes</th>
                    <th>Shares</th>
                    <th>Comments</th>
                    <th>Type</th>
                    <th>#Hashtags</th>
                    <th>Link in message</th>
                    <th>Link caption</th>
                    <th>Message</th>
                </thead>
            </table>
            <textarea name="analysis" id="analysis" class='span12' rows='8'></textarea>
        </div>
        
</div>
