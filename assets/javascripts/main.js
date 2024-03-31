import { Tooltip } from 'bootstrap'

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

// Enable Bootstrap tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new Tooltip(tooltipTriggerEl))