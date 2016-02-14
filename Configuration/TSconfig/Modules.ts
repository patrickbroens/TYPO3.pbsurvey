mod {
	wizards {
		// add content element survey to the new Content Element Wizard
		newContentElement {
			wizardItems {
				special {
					elements {
						pbsurvey {
							iconIdentifier = content-special-pbsurvey
							title = LLL:EXT:pbsurvey/Resources/Private/Language/ContentElementWizard.xlf:pbsurvey.title
							description = LLL:EXT:pbsurvey/Resources/Private/Language/ContentElementWizard.xlf:pbsurvey.description
							tt_content_defValues {
								CType = pbsurvey
							}
						}
					}
					show := addToList(pbsurvey)
				}
			}
		}
	}
}