@extends('layouts.app')
@section('css')
    <style>
        ul.pagination {
            /*display: inline-block;*/
            padding: 0;
            width:80%;
            margin: 0 auto;
            display:flex;
            align-items:center;
            justify-content:space-between;
        }

        .page-item {display: inline;}

        .page-item a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .page-item span {
            color: grey;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .page-item a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .page-item a:hover:not(.active) {background-color: #ddd;}
    </style>
@endsection
@section('content')
		<div id="main" class="content">
			<div class="container">
				<article itemscope="itemscope">
					<div class="posts-list js-posts">

                        @foreach($articles as $article)
						<div class="post post-layout-list" data-aos="fade-up">
							<div class="postnormal review ">
								<div class="post-container review-item">
									<div class="row review-item-wrapper">
										<div class="col-sm-3">
											<a rel="nofollow" href="/detail?id={{$article['id']}}">
												<div class="review-item-img" style="background-image: url({{$article['picture']}});"></div>
											</a>
										</div>
										<div class="col-sm-9 flex-xs-middle">
											<div class="review-item-title">
												<a href="/detail?id={{$article['id']}}" rel="bookmark">{{$article['title']}}</a>
											</div>
											<div class="review-item-creator"><b>发布日期：</b>{{$article['created_at']->diffForHumans()}}</div>
											<span class="review-item-info">Author:{{$article['author']}}</span>
										</div>
									</div>
									<div class="review-bg-wrapper">
										<div class="bg-blur" style="background-image: url({{$article['picture']}});"></div>
									</div>
								</div>
								<div class="post-container">
{{--									<div class="entry-content"></div>--}}
									<div class="post-footer">
										<a class="gaz-btn primary" href="/detail?id={{$article['id']}}">READ MORE</a>
{{--										<span class="total-comments-on-post pull-right"><a href="">31 Comments</a></span>--}}
									</div>
								</div>
							</div>
						</div>
                        @endforeach

					</div>
					<!-- post-formats end Infinite Scroll star -->
					<!-- post-formats -->
					<div>
						<div>

							{{$articles->links()}}
						</div>
					</div>
					<!-- -pagination  -->
                </article>
			</div>
		</div>
@endsection

