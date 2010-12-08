# encoding: utf-8

# =============================================================================
# package info
# =============================================================================
NAME = 'symmetrics_config_german'

TAGS = ('magento', 'module', 'symmetrics', 'config', 'german', 'mrg')

LICENSE = 'AFL 3.0'

HOMEPAGE = 'http://www.symmetrics.de'

INSTALL_PATH = ''

# =============================================================================
# responsibilities
# =============================================================================
TEAM_LEADER = {
    'Torsten Walluhn': 'tw@symmetrics.de',
}

MAINTAINER = {
    'Siegfried Schmitz': 'ss@symmetrics.de',
}

AUTHORS = {
    'Eugen Gitin': 'eg@symmetrics.de',
    'Siegfried Schmitz': 'ss@symmetrics.de',
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

REQUIRES = [
    {'magento': '*', 'magento_enterprise': '*'},
    {'mc_module_locale_mage_community_de_de': '*'},
]

EXCLUDES = {
}

DEPENDS_ON_FILES = (
)

PEAR_KEY = ''

COMPATIBLE_WITH = {
    'magento': ['1.4.0.1', '1.4.1.1'],
    'magento_enterprise': ['1.8.0.0', '1.9.0.0', '1.9.1.1'],
}
