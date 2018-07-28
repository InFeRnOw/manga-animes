<?php
include 'dbh-inc.php';

function adminPanelVote($lastedited){
  echo "<div class='divider-with-content'>
          <button id='hide-panel' class='btn' style='margin-bottom: 10px';>Hide panel</button>
          <p>lastly edited by: ".$lastedited."<p>
          <h2>Staff panel</h2>
          <form id=voteForm action='INCLUDES/vote-inc.php' method='POST'>
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-xs-4'>
                <button class='btn btn-success' type='submit' name='accept'>Accept</button>
              </div>
              <div class='col-xs-4'>
                <button class='btn btn-secondairy' type='submit' name='edit'>Edit</button>
              </div>
              <div class='col-xs-4'>
                <button class='btn btn-danger' type='submit' name='deny'>Deny</button>
              </div>
            </div>
            </br>
            <div class='row'>
              <div class='col-xs-6'>
                <button class='btn btn-primary' type='submit' name='like'><i class='glyphicon glyphicon-thumbs-up'></i></button>
              </div>
              <div class='col-xs-6'>
                <button class='btn btn-danger' type='submit' name='dislike'><i class='glyphicon glyphicon-thumbs-down'></i></button>
              </div>
            </div>
          </div>
          </form>
        </div>";
}

function authorPanelVote($lastedited){
    echo "<div class='divider-with-content'>
            <button id='hide-panel' class='btn' style='margin-bottom: 10px';>Hide panel</button>
            <p>lastly edited by: ".$lastedited."<p>
    		<h2>Author panel</h2>
    		<form id=voteForm action='INCLUDES/vote-inc.php' method='POST'>
    		<div class='container-fluid'>
    		  <div class='row'>
    			<div class='col-md-3 col-xs-6' style='margin-top: 15px;'>
    			  <button class='btn btn-secondairy' type='submit' name='edit'>Edit</button>
    			</div>
    			<div class='col-md-3 col-xs-6' style='margin-top: 15px;'>
    			  <button class='btn btn-danger' type='submit' name='deny'>Delete</button>
    			</div>
    			<div class='col-md-3 col-xs-6' style='margin-top: 15px;'>
    			  <button class='btn btn-primary' type='submit' name='like'><i class='glyphicon glyphicon-thumbs-up'></i></button>
    			</div>
    			<div class='col-md-3 col-xs-6' style='margin-top: 15px;'>
    			  <button class='btn btn-danger' type='submit' name='dislike'><i class='glyphicon glyphicon-thumbs-down'></i></button>
    			</div>
    		  </div>
    		</div>
    		</form>
    	  </div>";
}

function votePanel($lastedited) {
    echo "<div class='divider-with-content'>
            <button id='hide-panel' class='btn' style='margin-bottom: 10px';>Hide panel</button>
            <p>lastly edited by: ".$lastedited."<p>
            <h2>Vote panel</h2>
            <form id=voteForm action='INCLUDES/vote-inc.php' method='POST'>
            <div class='container-fluid'>
              <div class='row'>
                <div class='col-xs-6'>
                  <button class='btn btn-primary' type='submit' name='like'><i class='glyphicon glyphicon-thumbs-up'></i></button>
                </div>
                <div class='col-xs-6'>
                  <button class='btn btn-danger' type='submit' name='dislike'><i class='glyphicon glyphicon-thumbs-down'></i></button>
                </div>
              </div>
            </div>
          </form>
        </div>";
}

function adminPanel($lastedited){
  echo "<div class='divider-with-content'>
          <button id='hide-panel' class='btn' style='margin-bottom: 10px';>Hide panel</button>
          <p>lastly edited by: ".$lastedited."<p>
          <h2>Staff panel</h2>
          <form id=voteForm action='INCLUDES/vote-inc.php' method='POST'>
          <div class='container-fluid'>
            <div class='row'>
              <div class='col-xs-6'>
                <button class='btn btn-secondairy' type='submit' name='edit'>Edit</button>
              </div>
              <div class='col-xs-6'>
                <button class='btn btn-danger' type='submit' name='delete'>Delete</button>
              </div>
            </div>
            </br>
          </div>
          </form>
        </div>";
}

function authorPanel($lastedited){
    echo "<div class='divider-with-content'>
            <button id='hide-panel' class='btn' style='margin-bottom: 10px';>Hide panel</button>
            <p>lastly edited by: ".$lastedited."<p>
            <h2>Author panel</h2>
            <form id=voteForm action='INCLUDES/vote-inc.php' method='POST'>
            <div class='container-fluid'>
              <div class='row'>
                <div class='col-xs-6'>
                  <button class='btn btn-secondairy' type='submit' name='edit'>Edit</button>
                </div>
                <div class='col-xs-6'>
                  <button class='btn btn-danger' type='submit' name='delete'>Delete</button>
                </div>
                </br>
              </div>
            </div>
            </form>
          </div>";
}
