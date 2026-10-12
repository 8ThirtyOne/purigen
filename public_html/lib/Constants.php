<?php

class Constants
{
    public const INDUSTRY_TYPES = [
        null => '',
        1 => 'Biotech Organization',
        2 => 'University',
        3 => 'Government Research Organization',
        4 => 'Hospital/Clinical Services',
        5 => 'Research Institute',
        6 => 'Contract Research Organization',
        7 => 'Diagnostic/CLIA Testing Lab',
        8 => 'Medical Device Manufacturing',
        9 => 'Research Device Manufacturing',
        10 => 'Comprehensive Cancer Center',
    ];

    public const RESEARCH_TYPES = [
        null => '',
        1 => 'Gene Therapy',
        2 => 'Infectious Disease',
        3 => 'Molecular Biology',
        4 => 'Molecular Diagnostics',
        5 => 'Oncology',
        6 => 'Pathology',
        7 => 'Translational Research',
        8 => 'Other'
    ];

    public const ARTICLE_OR_PRESS = [
        null => '',
        1 => 'Press',
        2 => 'Article',
    ];

    public const EVENT_TYPES = [
        null => '- select one -',
        1 => 'Conference',
        2 => 'Seminar',
        3 => 'Meeting',
        4 => 'Online',
    ];

    public const LITERATURE_TYPES = [
        null => '- select one -',
        1 => 'BROCHURE',
        2 => 'FLYER',
        3 => 'WHITE PAPER / APP NOTE',
        4 => 'POSTER',
        5 => 'INFOGRAPHIC',
    ];

    public const VIDEO_TYPES = [
        null => '- select one -',
        1 => 'Purigen Isotachophoresis',
        2 => 'Webinars / Tutorials',
        3 => 'Procedures and Guides',
        4 => 'Interviews and Testimonials',
        5 => 'Events',
        6 => 'Animations',
        7 => 'Miscellaneous',
    ];

    public const BLOG_TYPES = [
        null => '- select one -',
        1 => 'Application',
        2 => 'Hardware',
        3 => 'Events and Company',
        4 => 'Guest Blog',
        5 => 'Literature',
    ];

           public const CUSTOMERPROFILE_TYPES = [
        null => '- select one -',
        1 => 'DNA / RNA from FFPE',
        2 => 'DNA from Tissue',
        3 => 'DNA from Cells',
        4 => 'RNA from Virus',
    ];
}