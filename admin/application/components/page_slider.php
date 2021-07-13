<div class="application__pages">
            <?php if($data["current_page"]!=1):?>
            <a href="<?php $page = $data["current_page"]-1; echo Page::getCurrentUrl()."?page=$page"  ?>">
                <div class="application__pages-arrow-left">
                    <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0)">
                            <path d="M1.16364 5.71603C1.16409 5.89525 1.23433 6.07427 1.37397 6.21057L5.77036 10.4995C6.05003 10.7724 6.50237 10.7712 6.78057 10.497C7.05877 10.2229 7.05768 9.77956 6.77813 9.5067L2.88795 5.71178L6.75925 1.89771C7.03745 1.6235 7.03636 1.18017 6.7568 0.907468C6.47725 0.634502 6.02492 0.635616 5.7466 0.909957L1.37139 5.22046C1.2324 5.35751 1.1632 5.53688 1.16364 5.71603Z"
                                  fill="#585855"/>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="10" height="6" fill="white"
                                      transform="matrix(-0.00246407 -0.999997 -0.999997 0.00246407 6.99023 10.7017)"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
            </a>
            <?php else:?>
            <div class="application__pages-arrow-left application__pages-arrow-left_inactive">
                <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                        <path d="M1.16364 5.71603C1.16409 5.89525 1.23433 6.07427 1.37397 6.21057L5.77036 10.4995C6.05003 10.7724 6.50237 10.7712 6.78057 10.497C7.05877 10.2229 7.05768 9.77956 6.77813 9.5067L2.88795 5.71178L6.75925 1.89771C7.03745 1.6235 7.03636 1.18017 6.7568 0.907468C6.47725 0.634502 6.02492 0.635616 5.7466 0.909957L1.37139 5.22046C1.2324 5.35751 1.1632 5.53688 1.16364 5.71603Z"
                              fill="#585855"/>
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect width="10" height="6" fill="white"
                                  transform="matrix(-0.00246407 -0.999997 -0.999997 0.00246407 6.99023 10.7017)"/>
                        </clipPath>
                    </defs>
                </svg>
            </div>
            <?php endif;?>
            <div class="application__pages-list"><span class="application__pages-current"><?php echo $data['current_page'] ?></span>
                из <span class="application__pages-all"><?php echo $data['pages'] ?></span></div>
            <?php if($data["current_page"]==$data["pages"]):?>
            <div class="application__pages-arrow-right application__pages-arrow-right_inactive">
                <svg width="8" height="11" viewBox="0 0 8 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                        <path d="M6.79249 5.67601C6.79039 5.49681 6.71849 5.31844 6.5776 5.18344L2.14161 0.935444C1.85943 0.665216 1.40712 0.670525 1.13147 0.947301C0.855824 1.22397 0.861028 1.66732 1.1431 1.93757L5.0683 5.69625L1.23254 9.54606C0.956893 9.82283 0.962097 10.2661 1.24417 10.5362C1.52624 10.8066 1.97854 10.8013 2.25431 10.5244L6.58935 6.17349C6.72706 6.03516 6.7946 5.85515 6.79249 5.67601Z"
                              fill="#585855"/>
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect width="10" height="6" fill="white"
                                  transform="matrix(0.0117373 0.999931 0.999931 -0.0117373 0.919922 0.744629)"/>
                        </clipPath>
                    </defs>
                </svg>
            </div>
            <?php else:?>
            <a href="<?php $page = $data["current_page"]+1; echo Page::getCurrentUrl()."?page=$page"  ?>">
                <div class="application__pages-arrow-right">
                    <svg width="8" height="11" viewBox="0 0 8 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0)">
                            <path d="M6.79249 5.67601C6.79039 5.49681 6.71849 5.31844 6.5776 5.18344L2.14161 0.935444C1.85943 0.665216 1.40712 0.670525 1.13147 0.947301C0.855824 1.22397 0.861028 1.66732 1.1431 1.93757L5.0683 5.69625L1.23254 9.54606C0.956893 9.82283 0.962097 10.2661 1.24417 10.5362C1.52624 10.8066 1.97854 10.8013 2.25431 10.5244L6.58935 6.17349C6.72706 6.03516 6.7946 5.85515 6.79249 5.67601Z"
                                  fill="#585855"/>
                        </g>
                        <defs>
                            <clipPath id="clip0">
                                <rect width="10" height="6" fill="white"
                                      transform="matrix(0.0117373 0.999931 0.999931 -0.0117373 0.919922 0.744629)"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
            </a>
            <?php endif;?>
</div>