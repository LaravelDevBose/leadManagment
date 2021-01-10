<div id="app">
    <app-admin-layout>
        <div class="container-fluid relative">
            <div class="row">
               <div class="col-lg-3">
                  <div class="iq-card">
                     <div class="iq-card-body">
                        <div class="">
                           <div class="iq-email-list">
                              <button class="btn btn-primary btn-lg btn-block mb-3 font-size-16 p-3" data-target="#compose-email-popup" data-toggle="modal"><i class="ri-send-plane-line mr-2"></i>New Message</button>
                              <div class="iq-email-ui nav flex-column nav-pills">
                                 <li class="nav-link active" role="tab" data-toggle="pill" href="#mail-inbox"><a href="index.html"><i class="ri-mail-line"></i>Inbox<span class="badge badge-primary ml-2">4</span></a></li>
                                 <li class="nav-link" role="tab" data-toggle="pill" href="#mail-starred"><a href="#"><i class="ri-star-line"></i>Starred</a></li>
                                 <li class="nav-link" role="tab" data-toggle="pill" href="#mail-snoozed"><a href="#"><i class="ri-time-line"></i>Snoozed</a></li>
                                 <li class="nav-link" role="tab" data-toggle="pill" href="#mail-draft"><a href="#"><i class="ri-file-list-2-line"></i>Draft</a></li>
                                 <li class="nav-link" role="tab" data-toggle="pill" href="#mail-sent"><a href="#"><i class="ri-mail-send-line"></i>Sent Mail</a></li>
                                 <li class="nav-link" role="tab" data-toggle="pill" href="#mail-trash"><a href="#"><i class="ri-delete-bin-line"></i>Trash</a></li>
                                 <li class="nav-link" role="tab" data-toggle="pill" href="#mail-important"><a href="#"><i class="ri-bookmark-line"></i>Important</a></li>
                                 <li class="nav-link" role="tab" data-toggle="pill" href="#mail-spam"><a href="#"><i class="ri-spam-line"></i>Spam</a></li>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-12 mail-box-detail">
                <div class="iq-card">
                    <div class="iq-card-body p-0">
                        <div class="">
                            <div class="iq-email-to-list p-3">
                                <div class="d-flex justify-content-between">
                                    <div class="iq-email-search d-flex" >
                                        <form class="mr-3 position-relative">
                                            <div class="form-group mb-0">
                                                <input type="text"   class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Search">
                                                <button type="submit" class="search-link"><i class="ri-search-line"></i></button>
                                            </div>
                                        </form>
                                        <ul>
                                            {{$paginate->links()}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="iq-email-listbox">
                                @if (!empty($paginate))
                                <ul class="iq-email-sender-list">
                                    @foreach ($paginate as $item)
                                    <li class="iq-unread">
                                        <div class="d-flex align-self-center">
                                            <div class="iq-email-sender-info">
                                                <a href="javascript: void(0);"
                                                   class="px-1"
                                                   style="display: inline-block">
                                                   {{$item->getFrom()}}
                                                </a>
                                            </div>
                                            <div class="iq-email-content">
                                                <a href="javascript: void(0);" class="iq-email-subject">
                                                    {{ $item->getSubject() }}&nbsp;–&nbsp;
                                                    <span>{{ $item->getTextBody() }}</span>
                                                </a>
                                                <div class="iq-email-date">{{ $item->getDate() }}</div>
                                            </div>
                                            <ul class="iq-social-media">
                                                <li><a href="#" @click.prevent="deleteItem(inbox.id)"><i class="ri-delete-bin-2-line"></i></a></li>
                                                <li><a href="#" @click.prevent="showMailDetails(inbox)"><i class="ri-file-list-2-line"></i></a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
               <div id="compose-email-popup" class="compose-popup modal modal-sticky-bottom-right modal-sticky-lg">
                  <div class="iq-card iq-border-radius-20 mb-0">
                     <div class="iq-card-body">
                        <div class="row align-items-center">
                           <div class="col-md-12 mb-3">
                              <h5 class="text-primary float-left"><i class="ri-pencil-fill"></i> Compose Message</h5>
                              <button type="submit" class="float-right close-popup" data-dismiss="modal"><i class="ri-close-fill"></i></button>
                           </div>
                        </div>
                        <form class="email-form">
                           <div class="form-group row">
                              <label for="inputEmail3" class="col-sm-2 col-form-label">To:</label>
                              <div class="col-sm-10">
                                 <select  id="inputEmail3" class="select2jsMultiSelect form-control" multiple="multiple">
                                    <option value="Petey Cruiser">Petey Cruiser</option>
                                    <option value="Bob Frapples">Bob Frapples</option>
                                    <option value="Barb Ackue">Barb Ackue</option>
                                    <option value="Greta Life">Greta Life</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="cc" class="col-sm-2 col-form-label">Cc:</label>
                              <div class="col-sm-10">
                                 <select  id="cc" class="select2jsMultiSelect form-control" multiple="multiple">
                                    <option value="Brock Lee">Brock Lee</option>
                                    <option value="Rick O'Shea">Rick O'Shea</option>
                                    <option value="Cliff Hanger">Cliff Hanger</option>
                                    <option value="Barb Dwyer">Barb Dwyer</option>
                                 </select>
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="subject" class="col-sm-2 col-form-label">Subject:</label>
                              <div class="col-sm-10">
                                 <input type="text"  id="subject" class="form-control">
                              </div>
                           </div>
                           <div class="form-group row">
                              <label for="subject" class="col-sm-2 col-form-label">Your Message:</label>
                              <div class="col-md-10">
                                 <textarea class="textarea form-control" rows="5">Next, use our Get Started docs to setup Tiny!</textarea>
                              </div>
                           </div>
                           <div class="form-group row align-items-center compose-bottom pt-3 m-0">
                              <div class="d-flex flex-grow-1 align-items-center">
                                 <div class="send-btn">
                                    <button type="submit" class="btn btn-primary">Send</button>
                                 </div>
                                 <div class="send-panel">
                                    <label class="ml-2 mb-0 iq-bg-primary rounded" for="file"> <input type="file" id="file" style="display: none"> <a><i class="ri-attachment-line"></i> </a> </label>
                                    <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="javascript:void();"> <i class="ri-map-pin-user-line text-primary"></i></a>  </label>
                                    <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="javascript:void();"> <i class="ri-drive-line text-primary"></i></a>  </label>
                                    <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="javascript:void();"> <i class="ri-camera-line text-primary"></i></a>  </label>
                                    <label class="ml-2 mb-0 iq-bg-primary rounded"> <a href="javascript:void();"> <i class="ri-user-smile-line text-primary"></i></a>  </label>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center">
                                 <div class="send-panel float-right">
                                    <label class="ml-2 mb-0 iq-bg-primary rounded" ><a href="javascript:void();"><i class="ri-settings-2-line text-primary"></i></a></label>
                                    <label class="ml-2 mb-0 iq-bg-primary rounded"><a href="javascript:void();">  <i class="ri-delete-bin-line text-primary"></i></a>  </label>
                                 </div>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </app-admin-layout>
</div>