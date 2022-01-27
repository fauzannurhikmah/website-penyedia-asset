<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade active show" id="list-details" role="tabpanel" aria-labelledby="list-details-list">
      <form action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <textarea name="name" id="name" class="form-control" style="min-height: 200px"></textarea>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-custom">Next</button>
            </div>
      </form>
    </div>
    <div class="tab-pane fade" id="list-files" role="tabpanel" aria-labelledby="list-files-list">
      <form action="">
          <div class="form-group">
            <label for="asset" class="form-label">Asset File</label>
            <input type="file" class="form-control" id="asset">
          </div>
          <div class="form-group">
            <label for="image" class="form-label">Featured Preview Image</label>
            <input type="file" class="form-control" id="image">
          </div>
          <div class="form-group text-right">
            <button type="submit" class="btn btn-custom">Next</button>
        </div>
      </form>
    </div>
    <div class="tab-pane fade" id="list-sorting" role="tabpanel" aria-labelledby="list-sorting-list">
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category" class="form-control">
                    <option selected disabled>Choose Category</option>
                    <option value="">Character</option>
                    <option value="">Vehicle</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" name="tags" id="tags" class="form-control inputtags" data-role="tagsinput">
            </div>
            <div class="form-group text-right">
                <button type="button" class="btn btn-custom">Next</button>
            </div>
    </div>
    <div class="tab-pane fade" id="list-preview" role="tabpanel" aria-labelledby="list-preview-list">
        <form action="">
            <div class="form-group">
              <label for="youtube" class="form-label">Youtube Link Video</label>
              <input type="text" class="form-control" id="youtube">
              <small class="text-info">Can be empty</small>
            </div>
            <div class="form-group">
              <label for="sketchfab" class="form-label">Sketchfab Model Link</label>
              <input type="text" class="form-control" id="sketchfab">
              <small class="text-info">Can be empty</small>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-custom">Next</button>
          </div>
        </form>
    </div>
    <div class="tab-pane fade" id="list-software" role="tabpanel" aria-labelledby="list-software-list">
        <form action="">
            <div class="form-group">
              <label for="software" class="form-label">Software</label>
              <select name="software" id="software" class="form-control">
                  <option selected disabled>Choose Software</option>
                  <option value="">Blender 2.9x</option>
                  <option value="">CINEMA 4D</option>
              </select>
            </div>
            <div class="form-group">
                <label for="render" class="form-label">Render Engine</label>
                <select name="render" id="render" class="form-control">
                    <option selected disabled>Choose Render Engine</option>
                    <option value="">Cycle</option>
                    <option value="">EEVEE</option>
                    <option value="">Workbench</option>
                </select>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-custom">Next</button>
          </div>
        </form>
    </div>
    <div class="tab-pane fade" id="list-licensing" role="tabpanel" aria-labelledby="list-licensing-list">
        <form action="">
            <div class="form-group">
              <label for="licensing" class="form-label">Licensing</label>
              <select name="licensing" id="licensing" class="form-control">
                  <option selected disabled>Choose Licensing</option>
                  <option value="">Free</option>
                  <option value="">Premium</option>
              </select>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-custom">Next</button>
          </div>
        </form>
    </div>
    <div class="tab-pane fade" id="list-final" role="tabpanel" aria-labelledby="list-final-list">
        <p>By checking the box below, you acknowledge that this blend was created by you, or by someone else who has given you explicit permission to publish it.</p>
        <form action="">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input position-relative mr-2" type="checkbox" name="accept" id="accept">
                    <label class="form-check-label" for="accept">
                        I Accept the <a href="">Terms and Conditions</a>
                    </label>
                </div>
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-custom">Upload</button>
          </div>
        </form>
    </div>
  </div>