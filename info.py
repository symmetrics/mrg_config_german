# encoding: utf-8

# =============================================================================
# package info
# =============================================================================
NAME = 'symmetrics_config_german'

TAGS = ('magento', 'module', 'symmetrics', 'config', 'german', 'grmanconfig')

LICENSE = 'AFL 3.0'

HOMEPAGE = 'http://www.symmetrics.de'

INSTALL_PATH = ''

# =============================================================================
# responsibilities
# =============================================================================
TEAM_LEADER = {
    'Sergej Braznikov': 'sb@symmetrics.de'
}

MAINTAINER = {
    'Eugen Gitin': 'eg@symmetrics.de'
}

AUTHORS = {
    'Eugen Gitin': 'eg@symmetrics.de'
}

# =============================================================================
# additional infos
# =============================================================================
INFO = 'symmetrics Basiskonfiguration für deutsche Shops'

SUMMARY = '''
    symmetrics Basiskonfiguration für deutsche Shops
'''

NOTES = '''
'''

# =============================================================================
# relations
# =============================================================================
REQUIRES = {
    'magento': '*',
    'symmetrics_module_impressum': '*',
    'symmetrics_module_invoicepdf': '*',
    'mc_module_locale_mage_community_de_de': '*',
}

EXCLUDES = {
}

DEPENDS_ON_FILES = (
)

PEAR_KEY = ''

COMPATIBLE_WITH = {
    'magento': '1.3.0'
}
