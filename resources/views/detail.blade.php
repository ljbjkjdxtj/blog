@extends('layouts.app')
@section('css')

@endsection
@section('content')
		<div id="main" class="content">
			<div class="container">
				<article id="post-1202" class="js-gallery post-1202 post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized tag-11 tag-22 tag-29">
					<style>
						.container {
							padding: 10px 0px;
						}

						.post {
							margin: 0 auto
						}
					</style>
					<section class="post_content">
						<header class="post_header">
							<h1 class="post_title">{{$article['title']}}</h1>
						</header>
                        <div class="meta split split--responsive cf">
                            <div class="split__title">
                                <time datetime="{{$article['updated_at']}}">{{$article['updated_at']->diffForHumans()}}</time>
                                BY {{$article['author']}}

                            </div>
                            @if(Auth::check())
                                <div style="text-align: right">
                                    <a style="margin-right: 0px;" href="/admin/modifyArticle?id={{$article['id']}}" target="_blank">编辑</a>
                                </div>
                            @endif
                        </div>
						<div class="post-body js-gallery">
                            <div id="layout"  class="editor">
                                <div id="test-editormd">
                                    <textarea style="display:none;" placeholder="markdown语言">{{$article['content']}}</textarea>
                                </div>
                            </div>
						</div>
                        <div class="meta split split--responsive cf">
                            <div class="split__title">
                                <span style="font-weight: bold;">
                                    标签：
                                    @foreach($labels as $label)
                                        <span class="badge badge-pill badge-success">{{$label['labels'][0]['label']}}</span>
                                    @endforeach
                                </span>
                            </div>
                        </div>
{{--						<div class="meta split split--responsive cf">--}}
{{--							<div class="slide">--}}
{{--								<a class="btn-slide" title="switch down"><i class="iconfont">&#xe615;</i>折叠评论区</a>--}}
{{--							</div>--}}
{{--						</div>--}}
					</section>
				</article>
			</div>
{{--			<svg id="upTriangleColor" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none">--}}
{{--				<path d="M0 0 L50 100 L100 0 Z"></path>--}}
{{--			</svg>--}}
{{--			<div id="social">--}}
{{--				<ul>--}}
{{--					<li>--}}
{{--						<a href="" title="qzone" target="_blank"><i class="iconfont">&#xe67f;</i></a>--}}
{{--					</li>--}}
{{--					<li>--}}
{{--						<a href="" title="weibo" target="_blank"><i class="iconfont">&#xe680;</i></a>--}}
{{--					</li>--}}
{{--					<li>--}}
{{--						<a href="" title="douban" target="_blank"><i class="iconfont">&#xe681;</i></a>--}}
{{--					</li>--}}
{{--					<li>--}}
{{--						<a href="" title="twitter" target="_blank"><i class="iconfont">&#xe683;</i></a>--}}
{{--					</li>--}}
{{--				</ul>--}}
{{--			</div>--}}
{{--			<div id="panel">--}}
{{--				<div class="comment-area">--}}
{{--					<section class="comments">--}}
{{--						<div class="comments-main">--}}
{{--							<div id="comments-list-title"><span>30</span> 条评论 </div>--}}
{{--							<div id="loading-comments">--}}
{{--								<div class="host">--}}
{{--									<div class="loading loading-0"></div>--}}
{{--									<div class="loading loading-1"></div>--}}
{{--									<div class="loading loading-2"></div>--}}
{{--								</div>--}}
{{--							</div>--}}
{{--							<ul class="commentwrap">--}}
{{--								<li class="comment even thread-even depth-1" id="li-comment-">--}}
{{--									<div id="comment-969" class="comment_body contents">--}}
{{--										<div class="profile">--}}
{{--											<a href=""><img src="statics/images/9cc50a9e422fb1c89aebafeb959cef7a.jpg" class="gravatar" alt="小布丁"></a>--}}
{{--										</div>--}}
{{--										<div class="main shadow">--}}
{{--											<div class="commentinfo">--}}
{{--												<section class="commeta">--}}
{{--													<div class="shang">--}}
{{--														<h4 class="author"><a href="" target="_blank"><img src="statics/images/9cc50a9e422fb1c89aebafeb959cef7a.jpg" class="gravatarsmall" alt="小布丁">小布丁</a></h4>--}}
{{--													</div>--}}
{{--												</section>--}}
{{--											</div>--}}
{{--											<div class="body">--}}
{{--												<p>挺好的</p>--}}
{{--											</div>--}}
{{--											<div class="xia info">--}}
{{--												<span><time datetime="2018-03-09">2018年3月9日</time></span>--}}
{{--												<span><a rel='nofollow' class='comment-reply-link' href="" onclick='return addComment.moveForm( "comment-969", "969", "respond", "1202" )' aria-label='回复给小布丁'>回复</a></span>--}}
{{--											</div>--}}
{{--										</div>--}}
{{--									</div>--}}
{{--								</li>--}}
{{--								<!-- #comment-## -->--}}
{{--							</ul>--}}
{{--							<nav id="comments-navi">--}}
{{--								<a class="prev page-numbers" href="">--}}
{{--									<</a>--}}
{{--										<a class='page-numbers' href="">1</a>--}}
{{--										<a class='page-numbers' href="">2</a>--}}
{{--										<a class='page-numbers' href="">3</a>--}}
{{--										<span aria-current='page' class='page-numbers current'>4</span></nav>--}}
{{--							<div id="respond" class="comment-respond">--}}
{{--								<h6 id="replytitle" class="comment-reply-title"><a rel="nofollow" id="cancel-comment-reply-link" href="" style="display:none;">取消</a></h6>--}}
{{--								<form action="#" method="post" id="commentform" class="clearfix">--}}
{{--									<div class="clearfix"></div>--}}
{{--									<div class="author-info">--}}
{{--										<input type="text" name="author" id="author" placeholder="昵  称 : " value="" tabindex="1" title="Name (required)" />--}}
{{--										<input type="text" name="email" id="email" placeholder="邮  箱 : " value="" tabindex="2" title="E-mail(will not be published) required" />--}}
{{--										<input type="text" name="url" id="url" placeholder="网  址 : " value="" tabindex="3" title="Website" />--}}
{{--									</div>--}}
{{--									<div class="clearfix"></div>--}}
{{--									<input type='hidden' name='comment_post_ID' value='1202' id='comment_post_ID' />--}}
{{--									<input type='hidden' name='comment_parent' id='comment_parent' value='0' />--}}
{{--									<p style="display: none;"><input type="hidden" id="akismet_comment_nonce" name="akismet_comment_nonce" value="632104fca1" /></p>--}}
{{--									<p style="display: none;"><input type="hidden" id="ak_js" name="ak_js" value="87" /></p>--}}
{{--									<div class="comment-form-info">--}}
{{--										<div class="real-time-gravatar"> <img id="real-time-gravatar" src="statics/images/d41d8cd98f00b204e9800998ecf8427e.png" alt="gravatar头像" />--}}
{{--										</div>--}}
{{--										<p class="input-row">--}}
{{--											<i class="row-icon"></i>--}}
{{--											<textarea class="text_area" rows="3" cols="80" name="comment" id="comment" tabindex="4" placeholder="你不说两句吗？(°∀°)ﾉ……"></textarea>--}}
{{--											<input type="submit" name="submit" class="button" id="submit" tabindex="5" value="发送" />--}}
{{--										</p>--}}
{{--									</div>--}}
{{--								</form>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</section>--}}
{{--				</div>--}}
{{--			</div>--}}
{{--			<svg id="dwTriangleColor" width="100%" height="40" viewBox="0 0 100 102" preserveAspectRatio="none">--}}
{{--				<path d="M0 0 L50 100 L100 0 Z"></path>--}}
{{--			</svg>--}}
{{--			<div class="wrapper">--}}
{{--			</div>--}}
		</div>

		<div class="p-header">
			<figure class="p-image" style="background-image: url(statics/images/47fb3c_9afed6c259f94589881bd55376206366mv2_d_3840_5784_s_4_2.jpg);"></figure>
		</div>

@endsection

@section('javascript')
{{--    <link rel="shortcut icon" href="https://pandao.github.io/editor.md/favicon.ico" type="image/x-icon" />--}}
{{--    <script src="/editor/jquery.min.js"></script>--}}
<script src="/editor/lib/marked.min.js"></script>
<script src="/editor/lib/prettify.min.js"></script>
<script src="/editor/lib/raphael.min.js"></script>
<script src="/editor/lib/underscore.min.js"></script>
<script src="/editor/lib/sequence-diagram.min.js"></script>
<script src="/editor/lib/flowchart.min.js"></script>
<script src="/editor/lib/jquery.flowchart.min.js"></script>
<script src="/editor/editormd.js"></script>
    <script>
        editormd.markdownToHTML("test-editormd", {
            htmlDecode      : "style,script,iframe",
            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true  // 默认不解析
        });
    </script>
@endsection
