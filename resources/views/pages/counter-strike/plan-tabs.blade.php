            <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false"> <h5 class="fw-bold text-danger"> 300FPS </h5> </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"> <h5 class="fw-bold text-warning"> 500FPS </h5> </button>
                </li>   
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="true"> <h5 class="fw-bold text-success"> 1000FPS </h5> </button>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                @include('pages/counter-strike/plans/300fps')
                @include('pages/counter-strike/plans/500fps')
                @include('pages/counter-strike/plans/1000fps')
            </div>