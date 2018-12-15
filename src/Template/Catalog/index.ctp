<div id="tabs">
<section style="margin-top: 20px">
        <div class="container">
            <div class="columns">
                <div class="column is-12">
                    <div class="tabs is-centered">
                        <ul>
                            <?php
                            foreach($navigations as $navigation) {
                                echo '<li navigation-id="' . $navigation->id . '"><a href="#tabs-' . $navigation->id . '"><span>' . $navigation->caption .'</span></a></li>';
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="columns">
                <div class="column is-3">
                    <nav class="panel">
                        <p class="panel-heading">
                            Catégories <a style="float: right;" class="button is-small is-success add-category"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        </p>
                        
                        <div style="height: 640px; display: block; overflow-x: visibile; overflow-y: auto;">
                            <?php
                            foreach($navigations as $navigation) {
                                echo '<div id="tabs-' . $navigation->id . '"></div>';
                            } ?>
                        </div>                      
                    </nav>
                </div>
                
                <div class="column is-7">
                    <div class="field">
                        <input id="modeEditor" type="checkbox" name="modeEditor" class="switch is-small is-rounded is-rtl">
                        <label for="modeEditor">Mode editeur</label>
                    </div>

                    <div style="height: 640px; width:100%; display: block; overflow-x: visibile; overflow-y: auto;">
                        <div id="items" class="selectable">
                        
                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="columns">
                <div class="column is-12">
                    <div class="field is-grouped is-grouped-centered">
                        <p class="control">
                            <a id="saveTheCatalog" class="button is-success">
                                Sauvegarder le catalogue
                            </a>
                        </p>
                    </div>
                </div>
            </div>-->
        </div>
    </section>
</div>