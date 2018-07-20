<?php
$isNew = true;
if ( segment( 4 ) != '' || $this->session->userdata('trip_data')) {
	$trip          = segment(4) != '' ? $trip[0] : $this->session->userdata('trip_data');
	$isNew         = false;
	$name          = $trip['name'];
	$slug          = $trip['slug'];
	$trip_id       = $trip['id'];
	$slug          = $trip['slug'];
	$canonical_url = $trip['canonical_url'];
	$is_new        = $trip['is_new'];
	$duration      = $trip['duration'];
	$max_altitude  = $trip['max_altitude'];
	$group_size    = $trip['group_size'];
	$grade         = $trip['grade'];
	$accommodation = $trip['accommodation'];
	$meals         = $trip['meals'];
	$overview      = $trip['overview'];
	$highlights    = $trip['highlights'];
	$itinerary     = $trip['itinerary'];
	$dest_id       = $trip['dest_id'];
	$old_discount        = $this->common_model->get_where( 'tbl_trip_discount', array( 'trip_id' => $trip_id ) );
	$discount            = isset($old_discount[0]['discount']) ? $old_discount[0]['discount'] : '';
	$primary_activity_id = $trip['primary_activity_id'];
	$act_id        = $this->common_model->get_where( 'tbl_trip_activity', array( 'trip_id' => $trip_id ) );
	$acts[]        = 0;
	if ( $act_id ) {
		foreach ( $act_id as $a ) {
			$acts[] = $a['act_id'];
		}
	}
	$act_id               = $acts;
	$starting_point       = $trip['starting_point'];
	$ending_point         = $trip['ending_point'];
	$trek_mode            = $trip['trek_mode'];
	$image                = isset($trip['image']) ? $trip['image'] : '';
	$featured             = isset($trip['featured']) ? $trip['featured'] : $trip['featured'];
	$cost                 = $trip['cost'];
	$include              = $trip['cost_inc'];
	$exclude              = $trip['cost_ex'];
	$notes                = $trip['notes'];
	$seo_meta_title       = $trip['seo_meta_title'];
	$seo_meta_keywords    = $trip['seo_meta_keywords'];
	$seo_meta_description = $trip['seo_meta_description'];
	$dates                = $trip['departure'];
	$similar              = isset($trip['similar']) ? explode( ',', $trip['similar'] ) : [];
	$transport            = $trip['transport'];
	$map                  = isset($trip['map']) ? $trip['map'] : '';
	$feature_image        = isset($trip['feature_image']) ? $trip['feature_image'] : '';
    $pdf_file             = isset($trip['pdf_file']) ? $trip['pdf_file'] : '';
	$leader               = $trip['leader'];
	$status               = isset($trip['status']) ? $trip['status'] : '';
}
?>
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Trip Manager | <?php echo ( $isNew ) ? 'Add' : 'Update' ?> <?php echo ( !$isNew ) ? ' : ' . $name : '' ?></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <span class="info"><?php if ( $isNew ) {
						echo "Save general to enable other links";
					} ?></span>
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-target="#general" data-toggle="tab">General</a></li>

                    <li><a data-target="#info" data-toggle="tab">Trip Info</a></li>
                    <li><a data-target="#includes" data-toggle="tab">Package Includes/Excludes</a></li>
                    <li><a data-target="#meta" data-toggle="tab">Meta</a></li>
                    <li><a data-target="#itinerary" data-toggle="tab">Itinerary</a></li>
                    <li><a data-target="#sliders" data-toggle="tab">Sliders</a></li>
                </ul>
                <div class="tab-content">
                    <div class="row tab-pane active" id="general">
                        <form action="" method="post" class="forms" enctype="multipart/form-data">
                            <div style="margin-top:10px;"></div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Trip Name</label>
                                <div class="col-md-8">
                                    <input id="slug-source" type="text" class="form-control" name="name"
                                           value="<?php echo ! $isNew ? $name : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Trip Slug</label>
                                <div class="col-md-8">
                                    <input id="slug-target" type="text" class="form-control" name="slug"
                                           value="<?php echo ! $isNew ? $slug : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Trip Duration(in days)</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="duration"
                                           value="<?php echo ! $isNew ? $duration : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Maximum Altitude(in meters)</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="max_altitude"
                                           value="<?php echo ! $isNew ? $max_altitude : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Group Size</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="group_size"
                                           value="<?php echo ! $isNew ? $group_size : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Cost</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="cost"
                                           value="<?php echo ! $isNew ? $cost : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Offer Price</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="discount"
                                           value="<?php echo ! $isNew ? $discount : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Difficulty Grade</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="grade">
                                        <option value="beginner" <?php echo ( ! $isNew && $grade == 'beginner' ) ? 'selected' : '' ?>>
                                            Beginner
                                        </option>
                                        <option value="easy" <?php echo ( ! $isNew && $grade == 'easy' ) ? 'selected' : '' ?>>
                                            Easy
                                        </option>
                                        <option value="moderate" <?php echo ( ! $isNew && $grade == 'moderate' ) ? 'selected' : '' ?>>
                                            Moderate
                                        </option>
                                        <option value="difficult" <?php echo ( ! $isNew && $grade == 'difficult' ) ? 'selected' : '' ?>>
                                            Difficult
                                        </option>
                                        <option value="advance" <?php echo ( ! $isNew && $grade == 'advance' ) ? 'selected' : '' ?>>
                                            Advance
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Starting Point</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="starting_point"
                                           value="<?php echo ! $isNew ? $starting_point : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Ending Point</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="ending_point"
                                           value="<?php echo ! $isNew ? $ending_point : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Destination</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="dest_id">
                                        <option value="">--select destination--</option>
										<?php
										$dest = $this->common_model->get_all( 'tbl_destinations' );
										foreach ( $dest as $d ) {
											?>
                                            <option value="<?php echo $d['id'] ?>" <?php echo ( ! $isNew && $d['id'] == $dest_id ) ? 'selected' : '' ?>>
												<?php echo $d['destination'] ?>
                                            </option>
										<?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Activity</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="act_id[]" multiple>
                                        <option value="">--select activity--</option>
										<?php
										$activity = $this->common_model->get_all( 'tbl_activities' );
										foreach ( $activity as $a ) {
											?>
                                            <option value="<?php echo $a['id'] ?>" <?php echo ( ! $isNew && in_array( $a['id'], $act_id ) ) ? 'selected' : '' ?>>
												<?php echo $a['activity'] ?>
                                            </option>
										<?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Primary Activity</label>
                                <div class="col-md-8">
                                    <select class="form-control" name="primary_activity_id">
                                        <option value="">--select primary activity--</option>
										<?php
										$activity = $this->common_model->get_all( 'tbl_activities' );
										foreach ( $activity as $a ) {
											?>
                                            <option value="<?php echo $a['id'] ?>" <?php echo ( ! $isNew && $a['id'] == $primary_activity_id ) ? 'selected' : '' ?>>
												<?php echo $a['activity'] ?>
                                            </option>
										<?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Choose Similar Trip</label>
                                <div class="col-md-8">
                                    <select name="similar[]" class="form-control" multiple>
										<?php
										$dest = ( ! $isNew ) ? $this->common_model->get_where( 'tbl_trips', array( 'id !=' => $trip_id ) ) : $this->common_model->get_all( 'tbl_trips' );
										foreach ( $dest as $d ) {
											?>
                                            <option value="<?php echo $d['id'] ?>" <?php echo ( ! $isNew && in_array( $d['id'], $similar ) ) ? 'selected' : '' ?>>
												<?php echo $d['name'] ?>
                                            </option>
										<?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Feature Image</label>
                                <div class="col-md-8">
                                    <input type="file" name="feature_image">
                                </div>
                            </div>
							<?php if ( ! $isNew && $feature_image != '' ) { ?>
                                <div class="form-group col-md-12">
                                    <img src="<?php echo base_url( 'images/trip/' . $feature_image ) ?>" width="20%">
                                </div>
							<?php } ?>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Map</label>
                                <div class="col-md-8">
                                    <input type="file" name="img">
                                </div>
                            </div>
							<?php if ( ! $isNew && $map != '' ) { ?>
                                <div class="form-group col-md-12">
                                    <img src="<?php echo base_url( 'images/maps/' . $map ) ?>" width="20%">
                                </div>
							<?php } ?>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">PDF File</label>
                                <div class="col-md-8">
                                    <input type="file" name="pdf_file">
                                </div>
                            </div>
	                        <?php if ( ! $isNew && $pdf_file != '' ) { ?>
                                <div class="form-group col-md-12">
                                    <a target="_blank" href="<?= base_url('pdf/' . $pdf_file) ?>">
                                        <i class="fa fa-file-pdf-o" style="font-size: 30px;"></i> <?= $pdf_file ?>
                                    </a>
                                </div>
	                        <?php } ?>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Status</label>
                                <div class="col-md-8">
                                    <input type="radio" name="status"
                                           value="0" <?= ( ! $isNew && ! $status ) ? 'checked' : '' ?>> Hide
                                    <input type="radio" name="status"
                                           value="1" <?= ( ! $isNew && $status ) ? 'checked' : '' ?>> Show
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">&nbsp;</label>
                                <span class="col-md-8 pull-right add-new">
                                    <button class="btn btn-success"> Save and Continue </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="row tab-pane" id="info">
                        <form action="" method="post" class="forms" enctype="multipart/form-data">
                            <div style="margin-top:10px;"></div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Accommodation</label>
                                <div class="col-md-8">
                                    <textarea name="accommodation" class="form-control"
                                              id="accommodation"><?php echo ! $isNew ? $accommodation : '' ?></textarea>
                                    <label for="accommodation" class="error" style="display:none;">This field is</label>
									<?php ?>
                                    <script type="text/javascript">
                                        var editor = CKEDITOR.replace('accommodation',
                                            {
                                                customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                                            });
                                        CKFinder.setupCKEditor(editor, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');
                                    </script>
									<?php ?>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Meals</label>
                                <div class="col-md-8">
                                    <textarea name="meals" class="form-control"
                                              id="meals"><?php echo ! $isNew ? $meals : '' ?></textarea>
                                    <label for="meals" class="error" style="display:none;">This field is</label>
									<?php ?>
                                    <script type="text/javascript">
                                        var editor = CKEDITOR.replace('meals',
                                            {
                                                customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                                            });
                                        CKFinder.setupCKEditor(editor, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');
                                    </script>
									<?php ?>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Transportation</label>
                                <div class="col-md-8">
                                    <textarea name="transport" class="form-control"
                                              id="transport"><?php echo ! $isNew ? $transport : '' ?></textarea>
                                    <label for="transport" class="error" style="display:none;">This field is</label>
                                <script type="text/javascript">
                                    var editor = CKEDITOR.replace('transport',
                                        {
                                            customConfig : '<?php echo base_url('assets/admin-assets/js/plugins/ckeditor/my_config.js') ?>'
                                        });
                                    CKFinder.setupCKEditor(editor, '<?php echo base_url('assets/admin-assets/js/plugins/ckfinder/')?>');
                                </script>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Overview</label>
                                <div class="col-md-8">
                                    <textarea name="overview" class="form-control"
                                              id="overview"><?php echo ! $isNew ? $overview : '' ?></textarea>
                                    <label for="overview" class="error" style="display:none;">This field is</label>
                                    <script type="text/javascript">
                                        var editor = CKEDITOR.replace('overview',
                                            {
                                                customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                                            });
                                        CKFinder.setupCKEditor(editor, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');
                                    </script>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-md-2">Highlights</label>
                                <div class="col-md-8">
                                    <textarea name="highlights" class="form-control"
                                              id="overview"><?php echo ! $isNew ? $highlights : '' ?></textarea>
                                    <label for="highlights" class="error" style="display:none;">This field is</label>
                                    <script type="text/javascript">
                                        var editor = CKEDITOR.replace('highlights',
                                            {
                                                customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                                            });
                                        CKFinder.setupCKEditor(editor, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');
                                    </script>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-md-2">&nbsp;</label>
                                <span class="col-md-8 pull-right add-new">
                                <button class="btn btn-success"> Save and Continue </button>
                            </span>
                            </div>
                        </form>
                    </div>
                    <div class="row tab-pane" id="includes">
                        <form action="" method="post" class="forms" enctype="multipart/form-data">
                            <div style="margin-top:10px;"></div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Include</label>
                                <div class="col-md-8">
                                    <textarea name="cost_inc" class="form-control"
                                              id="cost_inc"><?php echo ! $isNew ? $include : '' ?></textarea>
                                    <label for="cost_inc" class="error" style="display:none;">This field is</label>
                                    <script type="text/javascript">
                                        var editor = CKEDITOR.replace('cost_inc',
                                            {
                                                customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                                            });
                                        CKFinder.setupCKEditor(editor, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');
                                    </script>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Exclude</label>
                                <div class="col-md-8">
                                    <textarea name="cost_ex" class="form-control"
                                              id="cost_ex"><?php echo ! $isNew ? $exclude : '' ?></textarea>
                                    <label for="cost_ex" class="error" style="display:none;">This field is</label>
                                    <script type="text/javascript">
                                        var editor = CKEDITOR.replace('cost_ex',
                                            {
                                                customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                                            });
                                        CKFinder.setupCKEditor(editor, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');
                                    </script>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">&nbsp;</label>
                                <span class="col-md-8 pull-right add-new">
                                    <button class="btn btn-success"> Save and Continue </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="row tab-pane" id="excludes">
                        <form action="" method="post" class="forms" enctype="multipart/form-data">
                            <div style="margin-top:10px;"></div>

                            <div class="form-group col-md-12">
                                <label class="col-md-2">&nbsp;</label>
                                <span class="col-md-8 pull-right add-new">
                                    <button class="btn btn-success"> Save and Continue </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="row tab-pane" id="meta">
                        <form action="" method="post" class="forms" enctype="multipart/form-data">
                            <div style="margin-top:10px;"></div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Canonical URL</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="canonical_url" value="<?php echo (!$isNew) ? $canonical_url : '' ?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Meta Title</label>
                                <div class="col-md-8">
                                    <textarea name="seo_meta_title" class="form-control"
                                              id="seo_meta_title"><?php echo ! $isNew ? $seo_meta_title : '' ?></textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="col-md-2">Meta Keywords</label>
                                <div class="col-md-8">
                                    <textarea name="seo_meta_keywords" class="form-control"
                                              id="seo_meta_keywords"><?php echo ! $isNew ? $seo_meta_keywords : '' ?></textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="col-md-2">Meta Description</label>
                                <div class="col-md-8">
                                    <textarea name="seo_meta_description" class="form-control"
                                              id="seo_meta_description"><?php echo ! $isNew ? $seo_meta_description : '' ?></textarea>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <label class="col-md-2">About Leader</label>
                                <div class="col-md-8">
                                    <textarea name="leader" class="form-control"
                                              id="cost_ex"><?php echo ! $isNew ? $leader : '' ?></textarea>
                                    <label for="leader" class="error" style="display:none;">This field is</label>
                                    <script type="text/javascript">
                                        var editor = CKEDITOR.replace('leader',
                                            {
                                                customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                                            });
                                        CKFinder.setupCKEditor(editor, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');
                                    </script>
                                </div>
                            </div>


                            <div class="form-group col-md-12">
                                <label class="col-md-2">&nbsp;</label>
                                <span class="col-md-8 pull-right add-new">
                                    <button class="btn btn-success"> Save and Continue </button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="row tab-pane" id="itinerary">
                        <div style="margin-top:10px;"></div>
                        <form enctype="multipart/form-data" action="" class="form-horizontal" method="post">
                            <div class="panel panel-default">
                                <div class="row">
									<?php
									$c = 0;
									$itinerary = json_decode( $itinerary );
									if ( $itinerary && count($itinerary) > 0 ):foreach ( $itinerary as $index => $it ) {
										$c ++; ?>
                                        <div class="panel-body itinerary-panel">
                                            <div class="col-md-12 itinerary-panel-block">
                                                <div class="col-md-1">Day</div>
                                                <div class="col-md-1">
                                                    <input type="text" class="form-control" name="iti_day[]"
                                                           value="<?php echo $it->day ?>">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <input type="text" class="form-control" placholder="Title"
                                                               name="iti_title[]" value="<?php echo $it->title ?>">
                                                    </div>
                                                    <div class="row" style="margin-top:5px;">
                                                        <textarea name="iti_description[]"
                                                                  class="form-control cks_<?= $c ?>"
                                                                  placholder="Description"
                                                                  id="description"><?php echo $it->description ?></textarea>

                                                        <script>
                                                            var editor_2 = CKEDITOR.replaceAll('cks_<?= $c ?>',
                                                                {
                                                                    customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                                                                });
                                                            CKFinder.setupCKEditor(editor_2, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');

                                                        </script>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									<?php } else: ?>
                                        <div class="panel-body itinerary-panel">
                                            <div class="col-md-12 itinerary-panel-block">
                                                <div class="col-md-1">Day</div>
                                                <div class="col-md-1">
                                                    <input type="text" class="form-control" name="iti_day[]" value="">
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="row">
                                                        <input type="text" class="form-control" placholder="Title"
                                                               name="iti_title[]" value="">
                                                    </div>


                                                    <div class="row" style="margin-top:5px;">
                                                        <textarea name="iti_description[]" class="form-control testt"
                                                                  placholder="Description" id="cke_1"></textarea>
                                                        <script>
                                                            var editor_1 = CKEDITOR.replace('cke_1',
                                                                {
                                                                    customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                                                                });
                                                            CKFinder.setupCKEditor(editor_1, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');

                                                        </script>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
									<?php endif; ?>
                                    <div class='col-md-12'>
                                        <div class='btn btn-success col-md-2 new-iti pull-right'>Add New Itinerary</div>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    $(function () {

                                        $(".itinerary-panel-block").append("<a class='btn btn-danger col-md-3 del-iti'>Delete</a>");

                                        var c = 2;


                                        $(".new-iti").on("click", function () {


                                            var cloned =
                                                '<div class="panel-body itinerary-panel clone">' +
                                                '<div class="col-md-12 itinerary-panel-block">' +
                                                '<div class="col-md-1">Day</div>' +
                                                '<div class="col-md-1">' +
                                                '<input type="text" class="form-control" name="iti_day[]" value="">' +
                                                '</div>' +
                                                '<div class="col-md-7">' +
                                                '<div class="row">' +
                                                '<input type="text" class="form-control" placholder="Title" name="iti_title[]" value="">' +
                                                '</div>' +
                                                '<div class="row" style="margin-top:5px;">' +
                                                '<textarea name="iti_description[]" class="form-control cked_' + c + '" placholder="Description" id=""></textarea>' +
                                                '</div>' +
                                                '</div>' +
                                                '<a class="btn btn-danger col-md-3 del-iti">Delete</a>' +
                                                '</div>' +
                                                '</div>' +
                                                '';

                                            $(".itinerary-panel").last().after(cloned);

                                            c++;
                                            var editors = CKEDITOR.replaceAll('cked_' + (c - 1) + '',
                                                {
                                                    customConfig: '<?php echo base_url( 'assets/admin-assets/js/plugins/ckeditor/my_config.js' ) ?>'
                                                });
                                            CKFinder.setupCKEditor(editors, '<?php echo base_url( 'assets/admin-assets/js/plugins/ckfinder/' )?>');

                                        });


                                        $("#itinerary").on("click", "a.del-iti", function (e) {
                                            if(confirm('Are you sure?')) {
                                                $(this).parents('.itinerary-panel-block').remove();
                                                if($('.itinerary-panel-block').length == 0) {
                                                    $('.new-iti').trigger('click');
                                                }
                                                alert('Click save and continue button to save the changes.');
                                            }
                                        });
                                    });
                                </script>

                                <script type="text/javascript">

                                </script>


                                <div class="form-group col-md-12">
                                <span class="col-md-4 pull-right add-new">
                                    <button class="btn btn-success"> Save and Continue </button>
                                </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row tab-pane" id="sliders">
                        <div style="margin-top:10px;"></div>
						<?php
						$condition = $condition = array( 'trip_id' => segment( 4 ) );

						$sliders = $this->common_model->get_all( 'tbl_trip_slider', '', 'id DESC', '', $condition );
						?>
                        <div class="col-md-12">
                            <form enctype="multipart/form-data" action="../add_slider" class="form-horizontal"
                                  method="post">
                                <input type="hidden" name="trip_id" value="<?php echo ! $isNew ? $trip['id'] : '' ?>">
                                <div class="form-group">
                                    <label class="col-md-2">Select A file</label>
                                    <div class="col-md-4">
                                        <input type="hidden" name="slider_id" id="slider-id"/>
                                        Caption: <input class="form-control" type="text" id="slider-title" name="title"
                                                        placeholder="Caption">
                                        Source: <input class="form-control" type="text" id="slider-desccription" name="description"
                                                       placeholder="Source">
                                        ALT Tag: <input class="form-control" type="text" id="slider-alt" name="alt"
                                                       placeholder="ALT Tag"><br>
                                        <input type="file" name="photo">
                                        <button class="btn btn-success pull-right"> Save Image</button>

                                    </div>
                                    <!--                                            <div class="col-md-5 add-new">
																						<button class="btn btn-success"> Upload New Image </button>
																				</div>-->
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <table class="table table-bordered">
                                <tbody>
								<?php if ( ! empty( $sliders ) ) { ?>
                                    <tr>
                                        <td>Image</td>
                                        <td>Description</td>
                                        <td>Title</td>
                                        <td>ALT Tag</td>
                                        <td>Primary Image?</td>
                                        <td>Action</td>
                                    </tr>
									<?php foreach ( $sliders as $p ) { ?>
                                        <form enctype="multipart/form-data" action="" method="post">
                                            <tr>
                                                <td>
                                                    <img src="<?php echo base_url( 'images/trip/' . $p['image'] ) ?>"
                                                         width="25%">
                                                </td>
                                                <td><?= $p['description'] ?></td>
                                                <td>
													<?= $p['title'] ?>
                                                </td>
                                                <td><?= $p['alt'] ?></td>
                                                <td style="width:150px;">
                                                    <input type="checkbox" <?php echo ( $p['primary'] == 1 ) ? 'checked' : '' ?>
                                                           id="<?php echo $p['id'] . '_' . $p['primary'] ?>"
                                                           trip_id="<?php echo $p['trip_id'] ?>" class="make-primary">
                                                    Primary
                                                </td>
                                                <td style="width:150px;">
                                                    <a id="edit-slider" class="btn btn-sm btn-primary"
                                                       href="<?php echo base_url( 'admin/trip/edit_slider/' . $p['id'] ) ?>">Edit</a>
                                                    <a class="btn btn-sm btn-danger"
                                                       href="<?php echo base_url( 'admin/trip/delete_slider/' . $p['id'] ) ?>"
                                                       onclick="return confirm('Are you sure?')">Delete</a>
                                                </td>
                                            </tr>
                                        </form>
									<?php } ?>
								<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <script type="text/javascript">
        $(function () {
            $('#myTab a:first').tab('show')

            $('.make-primary').on('click', function () {
                var id = $(this).attr('id');
                var trip_id = $(this).attr('trip_id');
                $.ajax({
                    url: '<?php echo base_url( 'admin/trip/make_primary' ) ?>',
                    data: 'id=' + id + '&trip_id=' + trip_id,
                    type: 'post',
                    success: function () {
                        $('#msg').html('' +
                            '<div role="alert" class="alert alert-info alert-dismissible fade in">' +
                            '<button data-dismiss="alert" class="close" type="button">' +
                            '<span aria-hidden="true">×</span>' +
                            '<span class="sr-only">Close</span>' +
                            '</button>' +
                            'Trip saved' +
                            '</div>'
                        );
                    }
                });
            });
            
            $('#edit-slider').on('click', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    success: function(resp) {
                        resp = JSON.parse(resp);
                        $('#slider-id').val(resp.id);
                        $('#slider-title').val(resp.title);
                        $('#slider-description').val(resp.description);
                        $('#slider-alt').val(resp.alt);
                    }
                })
            })

            $('#slug-target').slugify('#slug-source');
        });
    </script>
