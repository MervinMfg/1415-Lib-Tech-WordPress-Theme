<?php
/*
Template Name: Board Finder
*/
get_header();
?>
          <div class="bg2-top"></div>
          <section class="board-finder bg2">
               <div class="section-content">
                    <div class="bf-step-1">
	                    <h1>Lib Tech Board Builder</h1>
	                    <?php the_content(); ?>
	                    <h3>Sniffing out the right<span>Lib Tech snowboard</span></h3>
	                    <div class="selection-who">
	                    	<h4>Who are you?</h4>
	                    	<ul>
	                    		<li class="left"><a href="#">Guy</a></li>
	                    		<li class="right"><a href="#">Girl</a></li>
	                    	</ul>
	                    </div>
					</div>
					<div class="bf-step-2">
						<div class="selection-measurements-left">
							<div class="weight-measurement">
								<h4>Weight</h4>
								<div class="weight-us">
									<select id="select-weight-us" class="select">
										<option value="1">Pounds</option>
										<option value="60" title="60">60</option>
										<option value="70" title="70">70</option>
										<option value="80" title="80">80</option>
										<option value="90" title="90">90</option>
										<option value="100" title="100">100</option>
										<option value="110" title="110">110</option>
										<option value="120" title="120">120</option>
										<option value="130" title="130">130</option>
										<option value="140" title="140">140</option>
										<option value="150" title="150">150</option>
										<option value="160" title="160">160</option>
										<option value="170" title="170">170</option>
										<option value="180" title="180">180</option>
										<option value="190" title="190">190</option>
										<option value="200" title="200">200</option>
										<option value="210" title="210">210</option>
										<option value="220" title="220">220</option>
										<option value="230" title="230">230</option>
										<option value="240" title="240">240</option>
										<option value="250" title="250">250</option>
										<option value="260" title="260">260</option>
										<option value="260+" title="260+">260+</option>
									</select>
								</div><!-- .weight-us -->
								<div class="weight-metric">
									<select id="select-weight-metric" class="select">
										<option value="1">Kilograms</option>
										<option value="27" title="27">27</option>
										<option value="31" title="31">31</option>
										<option value="35" title="35">35</option>
										<option value="39" title="39">39</option>
										<option value="43" title="43">43</option>
										<option value="47" title="47">47</option>
										<option value="51" title="51">51</option>
										<option value="55" title="55">55</option>
										<option value="59" title="59">59</option>
										<option value="63" title="63">63</option>
										<option value="67" title="67">67</option>
										<option value="71" title="71">71</option>
										<option value="75" title="75">75</option>
										<option value="79" title="79">79</option>
										<option value="83" title="83">83</option>
										<option value="87" title="87">87</option>
										<option value="91" title="91">91</option>
										<option value="95" title="95">95</option>
										<option value="99" title="99">99</option>
										<option value="103" title="103">103</option>
										<option value="107" title="107">107</option>
										<option value="111" title="111">111</option>
										<option value="115" title="115">115</option>
										<option value="119" title="119">119</option>
										<option value="123" title="123">123</option>
										<option value="123+" title="123+">123+</option>
									</select>
								</div><!-- .weight-metric -->
							</div> <!-- .weight-measurement -->
							<div class="boot-measurement">
								<h4>Boot</h4>
								<select id="select-boot-size" class="select">
									<option value="1">Size</option>
									<option value="4" title="4">4</option>
									<option value="4.5" title="4.5">4.5</option>
									<option value="5" title="5">5</option>
									<option value="5.5" title="5.5">5.5</option>
									<option value="6" title="6">6</option>
									<option value="6.5" title="6.5">6.5</option>
									<option value="7" title="7">7</option>
									<option value="7.5" title="7.5">7.5</option>
									<option value="8" title="8">8</option>
									<option value="8.5" title="8.5">8.5</option>
									<option value="9" title="9">9</option>
									<option value="9.5" title="9.5">9.5</option>
									<option value="10" title="10">10</option>
									<option value="10.5" title="10.5">10.5</option>
									<option value="11" title="11">11</option>
									<option value="11.5" title="11.5">11.5</option>
									<option value="12" title="12">12</option>
									<option value="12.5" title="12.5">12.5</option>
									<option value="13" title="13">13</option>
									<option value="13.5" title="13.5">13.5</option>
									<option value="14" title="14">14</option>
									<option value="14.5" title="14.5">14.5</option>
									<option value="15" title="15">15</option>
								</select>
							</div><!-- .boot-measurement -->
						</div><!-- .selection-measurements-left -->
						<div class="selection-measurements-right">
							<div class="height-measurement">
								<h4>Height</h4>
								<div class="height-us">
									<select id="select-height-feet-us" class="select">
										<option value="1">Feet</option>
										<option value="2" title="2">2</option>
										<option value="3" title="3">3</option>
										<option value="4" title="4">4</option>
										<option value="5" title="5">5</option>
										<option value="6" title="6">6</option>
									</select>
									<select id="select-height-inches-us" class="select">
										<option value="1">Inches</option>
										<option value="0" title="0">0</option>
										<option value="1" title="1">1</option>
										<option value="2" title="2">2</option>
										<option value="3" title="3">3</option>
										<option value="4" title="4">4</option>
										<option value="5" title="5">5</option>
										<option value="6" title="6">6</option>
										<option value="7" title="7">7</option>
										<option value="8" title="8">8</option>
										<option value="9" title="9">9</option>
										<option value="10" title="10">10</option>
										<option value="11" title="11">11</option>
									</select>
								</div><!-- .height-us -->
								<div class="height-metric">
									<select id="select-height-metric" class="select">
										<option value="1">Centimeters</option>	
										<option value="61" title="61">61</option>
										<option value="64" title="64">64</option>
										<option value="67" title="67">67</option>
										<option value="70" title="70">70</option>
										<option value="73" title="73">73</option>
										<option value="76" title="76">76</option>
										<option value="79" title="79">79</option>
										<option value="82" title="82">82</option>
										<option value="85" title="85">85</option>
										<option value="88" title="88">88</option>
										<option value="91" title="91">91</option>
										<option value="94" title="94">94</option>
										<option value="97" title="97">97</option>
										<option value="100" title="100">100</option>
										<option value="103" title="103">103</option>
										<option value="106" title="106">106</option>
										<option value="109" title="109">109</option>
										<option value="112" title="112">112</option>
										<option value="115" title="115">115</option>
										<option value="118" title="118">118</option>
										<option value="121" title="121">121</option>
										<option value="124" title="124">124</option>
										<option value="127" title="127">127</option>
										<option value="130" title="130">130</option>
										<option value="133" title="133">133</option>
										<option value="136" title="136">136</option>
										<option value="139" title="139">139</option>
										<option value="142" title="142">142</option>
										<option value="145" title="145">145</option>
										<option value="148" title="148">148</option>
										<option value="151" title="151">151</option>
										<option value="154" title="154">154</option>
										<option value="157" title="157">157</option>
										<option value="160" title="160">160</option>
										<option value="163" title="163">163</option>
										<option value="166" title="166">166</option>
										<option value="169" title="169">169</option>
										<option value="172" title="172">172</option>
										<option value="175" title="175">175</option>
										<option value="178" title="178">178</option>
										<option value="181" title="181">181</option>
										<option value="184" title="184">184</option>
										<option value="187" title="187">187</option>
										<option value="190" title="190">190</option>
										<option value="193" title="193">193</option>
										<option value="196" title="196">196</option>
										<option value="199" title="199">199</option>
										<option value="202" title="202">202</option>
										<option value="205" title="205">205</option>
										<option value="208" title="208">208</option>
										<option value="211" title="211">211</option>
										<option value="214" title="214">214</option>
									</select>
								</div><!-- .height-metric -->
								<div class="button-next">
									<a href="">Next</a>
								</div>
							</div><!-- .height-measurement -->
						</div><!-- .selection-measurements-right -->
					</div><!-- .bf-step-2 -->
					<div class="bf-step-3">
						<div class="selection-ability">
							<h4>What's your ability</h4>
							<ul>
								<li class="left"><a href="">Starter</a></li>
								<li class="center"><a href="">Middle</a></li>
								<li class="right"><a href="">Top</a></li>
							</ul>
						</div><!-- .selection-ability -->
					</div><!-- .bf-step-3 -->
					<div class="bf-step-4">
						<h2>Our board picks for you</h2>
						<ul class="product-filtering snowboards">
							<li class="filters ability left">
								<p class="select-title">ability</p>
								<p class="selected-items">select</p>
							</li>
							<li class="filters aggression center">
								<p class="select-title">agression</p>
								<p class="selected-items">select</p>
							</li>
							<li class="filters flex right">
								<p class="select-title">flex</p>
								<p class="selected-items">select</p>
							</li>
						</ul>
						<div class="board-picks">
							board picks go here
						</div>
					</div><!-- .bf-step-4 -->
					<div class="bf-step-5">
						<h2>Why these boards?</h2>
						<h3>It is important to get the right snowboard for maximun pleasure</h3>
						<div class="selection-why">
							<ul>
								<li class="left"><a href="">Length</a></li>
								<li class="center"><a href="">Width</a></li>
								<li class="right"><a href="">Contour</a></li>
							</ul>
						</div>
						<div class="description-wrapper">
							<div class="description">
								<h4>Length</h4>
								<p>A longer board is more stable while a shorter board is more manuverable. The trick is finding the right balance in the middle and then tweaking it to your riding style.</p>
								<p>More info about the length here</p>
							</div>
						</div>
					</div><!-- .bf-step-5 -->
               </div><!-- END .section-content -->
          </section><!-- END .board-finder -->

<?php get_footer(); ?>