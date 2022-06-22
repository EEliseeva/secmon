<?php
  use yii\helpers\Json;
  use yii\helpers\Url;

  $colsDown = \app\models\EventsNormalized::getColumnsDropdown();
  $loggedUserId = Yii::$app->user->getId();
  $options =  Json::decode($component->config);
  $filters = \app\controllers\FilterController::getFiltersOfUser($loggedUserId);
  $contentTypes = [
      'table' => 'Table',
      'barChart' => 'Bar chart',
      'pieChart' => 'Pie chart',
  ];
  $columns = \app\models\EventsNormalized::getColumnsDropdown();
?>

<div  id='component_<?= $component->id ?>'>
    <div class='grid-item card <?= $options['width'] ?>'>
        <!--Main content of component-->
        <div class="card-content">
            <div class="card-header">
                <span class="card-title activator grey-text text-darken-4">
                    <span class="nameTitle"><?php  echo $options['name']; ?></span>
                    <a href="#settings<?= $component->id ?>">
                        <i class="material-icons right">more_vert</i>
                    </a>
                </span>
                <a href="#modal<?= $component->id ?>" class="btn-floating waves-effect waves-light btn-small blue"
                   style="position:absolute; top: 30px; right: 40px; display: <?= $component->filter_id == null ? 'none' : 'block' ?>" id="contentEdit">
                    <i class="material-icons">edit</i>
                </a>
            </div>

            <div class="card-body">
                <!--Visible: If no filter was added to component-->
                <div class="section center-align" id="componentContentBodyNew<?= $component->id ?>" style="display: <?= $component->filter_id == null ? 'block' : 'none' ?>">
                    <a class="waves-effect waves-light btn-large" <?php printf("href='#modal%s'", $component->id) ?>><i class="material-icons right">add_circle_outline</i>Add content</a>
                </div>

                <!--Visible: If filter was added to component-->
                <div class="section center-align" id="componentContentBody<?= $component->id ?>" data-type='<?= $component->data_type ?>' style="display: <?= $component->filter_id != null ? 'block' : 'none' ?>">
                    <div id="componentLoader" class="preloader-wrapper active" style="display: inline-block">
                        <div class="spinner-layer spinner-blue-only">
                            <div class="circle-clipper left"><div class="circle"></div></div>
                            <div class="gap-patch"><div class="circle"></div></div>
                            <div class="circle-clipper right"><div class="circle"></div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Component options-->

    </div>

    <div class="modal" id="settings<?= $component->id ?>">
        <div class="modal-content">
            <i class="material-icons right close-modal">close</i><h4 class="nameHeader"><?php  echo $options['name']; ?> - options</h4>
            <form class="row componentForm"  data-id="<?php  echo $component->id; ?>">
                <div class="input-field col s12">
                    <label class="active" for="name">Name</label>
                    <input class="nameInput" data-id="component_<?php  echo $component->id; ?>" onmouseup="return false;" id="name<?php  echo $component->id; ?>" type="text" value="<?php  echo $options['name']; ?>">
                </div>

                <div class="input-field col s12">
                    <label class="active">Select width</label>
                    <select id="width<?php  echo $component->id; ?>" class="widthSelect" data-id="component_<?php  echo $component->id; ?>">
                        <option <?= $options['width'] == '' ? ' selected="selected"' : '' ?> value="">25%</option>
                        <option <?= $options['width'] == 'width2' ? ' selected="selected"' : '' ?> value="width2">50%</option>
                        <option <?= $options['width'] == 'width3' ? ' selected="selected"' : '' ?> value="width3">75%</option>
                        <option <?= $options['width'] == 'width4' ? ' selected="selected"' : '' ?> value="width4">100%</option>
                    </select>
                </div>

                <div class="input-field col s12 center-align">
                    <button type="button" class="deleteComponentBtn btn waves-effect waves-light red" data-id="<?php  echo $component->id; ?>">
                        Delete
                        <i class="material-icons right">delete</i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal" id="modal<?= $component->id ?>">
        <div class="modal-content">
            <h4>Content settings</h4>

            <form action="#" id="contentSettingsForm<?= $component->id ?>">
                <div class="row">
                    <div class=" input-field col s11">
                        <input type="hidden" name="componentId" value="<?= $component->id ?>" />

                        <select id="componentFilterId<?= $component->id ?>" name="filterId">
                            <?php foreach ($filters as $filter):  ?>
                                <option value="<?= $filter->id ?>"<?= $component->filter_id == $filter->id ? " selected='selected'" : "" ?>><?= $filter->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="componentFilterId<?= $component->id ?>">Filter Select</label>
                    </div>

                    <div class="input-field col s1">
                        <div class="help-block left-align">
                            <a href="<?= Url::to(["filter/create"]) ?>" class="btn-floating btn-small waves-effect waves-light red"
                               title="Create new filter">
                                <i class="material-icons">add</i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s11">
                        <select id="componenContentTypeId<?= $component->id ?>" name="contentTypeId" data-type="contentTypeSelect" data-id="<?= $component->id ?>">
                            <?php foreach ($contentTypes as $key => $type): ?>
                                <option value="<?= $key ?>"<?= ($component->data_type ?? "") == $key ? " selected='selected'" : "" ?>><?= $type ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="componenContentTypeId<?php print($component->id); ?>">Content type visualisation</label>
                    </div>
                </div>

                <div class="row">
                    <?php foreach ($contentTypes as $key => $type): ?>
                        <div data-content-type="<?= $key ?>" class="input-field col s11">
                            <?php if ($key == 'table') : ?>
                                <input type="hidden" name="dataTypeParameter" id="componentDataTypeParameter<?= $component->id ?>" />
                                <p class="caption">Table columns</p>
                                <div id="chipsTable<?= $component->id ?>" class="chips chips-table" data-id="<?= $component->id ?>"
                                     data-table-columns="<?= ($component->data_type ?? "") == $key && !empty($component->data_param) ? $component->data_param : 'datetime,host,protocol'
                                     ?>">
                                </div>
                            <?php elseif ($key == 'barChart') : ?>
                                <input type="text" id="componentContentParameter<?= $component->id ?>" name="dataTypeParameter"
                                       value="<?= ($component->data_type ?? "") == $key && !empty($component->data_param) ? $component->data_param : "" ?>"
                                       placeholder="nY/nM/nW/nD/nH/nm/nS"/>
                                <label for="componentContentParameter<?= $component->id ?>">Time range</label>
                            <?php else : ?>
                                <select id="componentContentParameter<?= $component->id ?>" name="dataTypeParameter">
                                    <?php foreach ($colsDown as $key1 => $val1) : ?>
                                        <?php if ($key1 == $component->data_param) : ?>
                                            <option value="<?= $key1 ?>" selected><?= $val1 ?></option>
                                        <?php else : ?>
                                            <option value="<?= $key1 ?>"><?= $val1 ?></option>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </select>
                                <label>Filtered column</label>
                            <?php endif; ?>
                        </div>

                        <?php if ($key == 'table') : ?>
                        <div data-content-type="<?= $key ?>" class=" input-field col s11">
                            <select id="columnsSelect<?= $component->id ?>">
                                <?php foreach ($colsDown as $key1 => $val1) : ?>
                                <option value="<?= $key1 ?>"><?= $val1 ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label>Add column</label>
                        </div>

                        <div data-content-type="<?= $key ?>" class="input-field col s1">
                            <div class="help-block left-align">
                                <a href="#" data-type="columnsSelectAdd" data-id="<?= $component->id ?>" class="btn-floating btn-small waves-effect waves-light red"
                                   title="Add new column">
                                    <i class="material-icons">add</i>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </form>
        </div>

        <div class="modal-footer">
            <div class="left" id="removeComponentContentBtn<?= $component->id ?>" style="display: <?= $component->filter_id == null ? "none" : "block" ?>">
                <button data-action="removeComponentContent" data-id="<?= $component->id ?>" class="modal-action modal-close waves-effect waves-red btn-flat">Delete content</button>
            </div>

            <div class="right">
                <button data-id="<?= $component->id ?>" data-action="saveComponentContent" class="modal-action modal-close waves-effect waves-green btn-flat">Save</button>

                <button class=" modal-close waves-effect waves-green btn-flat">Cancel</button>
            </div>
        </div>
    </div>
</div>
