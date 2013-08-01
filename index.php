<?php
namespace fshark;
include_once("include/headwithoutangular.php");
include_once("include/header.php");
include_once("navbar.php");
?>
<div class="container">
        <h1>WebShark</h1>
        <h2 class="lead">Packet analyzer</h2>
        <blockquote>
            <p>Supports tshark based filtering.<br>
            Things like what we do can be added here.</p>
        </blockquote>
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="/server/php/index.php" method="POST" enctype="multipart/form-data" data-ng-app="demo" data-ng-controller="DemoFileUploadController" data-file-upload="options" data-ng-class="{'fileupload-processing': processing() || loadingFiles}">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="span7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button" ng-class="{disabled: disabled}">
                    <i class="icon-plus icon-white"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple ng-disabled="disabled" accept=".pcap, .gz">
                </span>
                <button type="button" class="btn btn-primary start" data-ng-click="submit()">
                    <i class="icon-upload icon-white"></i>
                    <span>Start upload</span>
                </button>
                <button type="button" class="btn btn-warning cancel" data-ng-click="cancel()">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel upload</span>
                </button>
                <!-- The loading indicator is shown during file processing -->
                <div class="fileupload-loading"></div>
            </div>
            <!-- The global progress information -->
            <div class="span5 fade" data-ng-class="{in: active()}">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" data-file-upload-progress="progress()"><div class="bar" data-ng-style="{width: num + '%'}"></div></div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table class="table table-striped files ng-cloak">
            <tr data-ng-repeat="file in queue">
                <td data-ng-switch data-on="!!file.thumbnailUrl">
                    <div class="preview" data-ng-switch-when="true">
                        <a data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery><img data-ng-src="{{file.thumbnailUrl}}" alt=""></a>
                    </div>
                    <div class="preview" data-ng-switch-default data-file-upload-preview="file"></div>
                </td>
                <td>
                    <p class="name" data-ng-switch data-on="!!file.url">
                        <span data-ng-switch-when="true" data-ng-switch data-on="!!file.thumbnailUrl">
                            <a data-ng-switch-when="true" data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}" data-gallery>{{file.name}}</a>
                            <a data-ng-switch-default data-ng-href="{{file.url}}" title="{{file.name}}" download="{{file.name}}">{{file.name}}</a>
                        </span>
                        <span data-ng-switch-default>{{file.name}}</span>
                    </p>
                    <div data-ng-show="file.error"><span class="label label-important">Error</span> {{file.error}}</div>
                </td>
                <td>
                    <p class="size">{{file.size | formatFileSize}}</p>
                    <div class="progress progress-success progress-striped active fade" data-ng-class="{pending: 'in'}[file.$state()]" data-file-upload-progress="file.$progress()"><div class="bar" data-ng-style="{width: num + '%'}"></div></div>
                </td>
                <td>
                    <button type="button" class="btn btn-primary start" data-ng-click="file.$submit()" data-ng-hide="!file.$submit">
                        <i class="icon-upload icon-white"></i>
                        <span>Start</span>
                    </button>
                    <button type="button" class="btn btn-warning cancel" data-ng-click="file.$cancel()" data-ng-hide="!file.$cancel">
                        <i class="icon-ban-circle icon-white"></i>
                        <span>Cancel</span>
                    </button>
                    <button data-ng-controller="FileDestroyController" type="button" class="btn btn-danger destroy" data-ng-click="file.$destroy()" data-ng-hide="!file.$destroy">
                        <i class="icon-ban-circle icon-white"></i>
                        <span>Delete</span>
                    </button>
                </td>
            </tr>
        </table>
    </form>
    <br>
    <div class="well">
        <h3>Usage</h3>
        <ul>
            <li>No restriction on upload file size.</li>
            <li>Uploaded files will be deleted automatically once you close the browser.</li>
            <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage with Google Chrome, Mozilla Firefox and Apple Safari.</li>
        </ul>
    </div>
</div>
<div id="footer">
  <div class="container">
    <p>&copy; WebShark - 2013 </p>
  </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.5/angular.min.js"></script>
<script src="js/vendor/jquery.ui.widget.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="http://blueimp.github.io/cdn/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="http://blueimp.github.io/Gallery/js/blueimp-gallery.min.js"></script>
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="js/jquery.fileupload-process.js"></script>
<!-- The File Upload validation plugin -->
<script src="js/jquery.fileupload-validate.js"></script>
<!-- The File Upload Angular JS module -->
<script src="js/jquery.fileupload-angular.js"></script>
<!-- The main application script -->
<script src="js/app.js"></script>
</body> 
</html>
