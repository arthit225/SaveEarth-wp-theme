/* Libs */
import $ from 'jquery';

/* Global helpers */
import toggleBodyClass from "./helpers/toggle-nav";

/* Theme components */
import initializeLetterSwiper from "./components/letter-swiper";
import initializeTextMarquee from "./components/text-marquee";
import initializeFloatingImages from "./components/floating-images";
import initializeTeam from "./components/team";
import videoHero from './components/video-hero';
import initializeVideoModal from "./components/modal-video";

$(function(){
  initializeLetterSwiper();
  initializeTextMarquee();
  initializeFloatingImages();
  toggleBodyClass();
  videoHero();
  initializeTeam();
  initializeVideoModal();
});