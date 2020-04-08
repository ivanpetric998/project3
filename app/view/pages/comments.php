<div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2">

                <h3 class="center-align">Comments</h3>
                
                <form action="" method="post">

                <div class="input-field col s12">

                    <select class="browser-default" id="category">
                        <option value="0">Choose category</option>

                        <?php foreach($data['categories'] as $i): ?>

                            <option value="<?=$i->idCategory;?>"><?=$i->nameCategory;?></option>
                        
                        <?php endforeach; ?>
                    </select>

                </div>
                

                <div class="input-field col s12">
                    <textarea id="comment" class="materialize-textarea"></textarea>
                    <label for="comment">Add comment</label>
                </div>

                <div class="input-field col s12" id="messages">

                </div>

                <div class="input-field col s12">

                    <button class="btn waves-effect waves-light" id="insert" type="button" name="action">Send
                        <i class="material-icons right">send</i>
                    </button>
        
                </div>

                </form>

                <div class="input-field col s12" id="divForComments">

                </div>

                <!-- Modal Structure -->
                <div id="commentModal" class="modal">
                    <div class="modal-content">
                        <div class="input-field col s12">
                            <textarea id="subComment" class="materialize-textarea"></textarea>
                            <label for="subComment">Add comment</label>
                        </div>
                        <input type="hidden" id="hiddenParent" value=""/>
                        <button class="btn waves-effect waves-light" id="insertSubComment" type="button">Send
                            <i class="material-icons right">send</i>
                        </button>
                        <div class="input-field col s12" id="modalMessage">
                            
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>